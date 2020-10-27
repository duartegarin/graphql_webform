<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Mutations;

use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Mutations\MutationPluginBase;
use Drupal\graphql_webform\GraphQL\WebformFileUploadOutputWrapper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Drupal\webform\Entity\Webform;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * TODO: Add the whole range of file upload validations from file_save_upload().
 *
 * @GraphQLMutation(
 *   id = "webform_file_upload",
 *   secure = "false",
 *   name = "webformFileUpload",
 *   type = "WebformFileUploadOutput",
 *   arguments = {
 *     "file" = "Upload!",
 *     "webform_id" = "String!",
 *     "webform_element_id" = "String!"
 *   }
 * )
 */
class WebformFileUpload extends MutationPluginBase implements ContainerFactoryPluginInterface {
  use DependencySerializationTrait;
  use StringTranslationTrait;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The mime type guesser service.
   *
   * @var \Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface
   */
  protected $mimeTypeGuesser;

  /**
   * The file system service.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $pluginId,
    $pluginDefinition,
    EntityTypeManagerInterface $entityTypeManager,
    AccountProxyInterface $currentUser,
    MimeTypeGuesserInterface $mimeTypeGuesser,
    FileSystemInterface $fileSystem
  ) {
    parent::__construct($configuration, $pluginId, $pluginDefinition);
    $this->entityTypeManager = $entityTypeManager;
    $this->currentUser = $currentUser;
    $this->mimeTypeGuesser = $mimeTypeGuesser;
    $this->fileSystem = $fileSystem;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $pluginId, $pluginDefinition) {
    return new static(
      $configuration,
      $pluginId,
      $pluginDefinition,
      $container->get('entity_type.manager'),
      $container->get('current_user'),
      $container->get('file.mime_type.guesser'),
      $container->get('file_system')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function resolve($value, array $args, ResolveContext $context, ResolveInfo $info) {
    /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
    $file = $args['file'];

    // Do not proceed if file argument is invalid.
    if (!($file instanceof UploadedFile)) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
        'File argument is invalid. Expected \Symfony\Component\HttpFoundation\File\UploadedFile.',
      ]);
    }

    // Check for file upload errors and return FALSE for this file if a lower
    // level system error occurred.
    //
    // @see http://php.net/manual/features.file-upload.errors.php.
    switch ($file->getError()) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE: {
        $max_filesize = \Drupal::config('webform.settings')->get('file.default_max_filesize') ?: Environment::getUploadMaxSize();
        return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
          $this->t('The file %file could not be saved because it exceeds %maxsize, the maximum allowed size for uploads.', [
            '%file' => $file->getFilename(),
            '%maxsize' => format_size($max_filesize),
          ]),
        ]);
      }

      case UPLOAD_ERR_PARTIAL:
      case UPLOAD_ERR_NO_FILE:
        return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
          $this->t('The file %file could not be saved because the upload did not complete.', [
            '%file' => $file->getFilename(),
          ]),
        ]);

      case UPLOAD_ERR_OK:
        // Final check that this is a valid upload, if it isn't, use the
        // default error handler.
        if (is_uploaded_file($file->getRealPath())) {
          break;
        }

      default:
        // Unknown error.
        return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
          $this->t('The file %file could not be saved. An unknown error has occurred.', [
            '%file' => $file->getFilename(),
          ]),
        ]);
    }

    // Load the webform.
    $webform = Webform::load($args['webform_id']);

    // Validate the if webform_id argument is valid.
    if (!$webform) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
        $this->t('The webform %webform_id does not exist.', [
          '%webform_id' => $args['webform_id'],
        ]),
      ]);
    }

    // Get the webform element.
    $file_element = $webform->getElement($args['webform_element_id']);
    if (!$file_element) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
        $this->t('The webform_element_id %webform_element_id does not exist.', [
          '%webform_element_id' => $args['webform_element_id'],
        ]),
      ]);
    }

    $filename = $file->getClientOriginalName();
    $mime = $this->mimeTypeGuesser->guess($filename);
    $scheme = isset($file_element['#uri_scheme']) ? $file_element['#uri_scheme'] : 'private';

    $upload_location = $scheme . '://webform/' . $webform->id() . '/_sid_';

    // Make sure the upload location exists and is writable.
    $this->fileSystem->prepareDirectory($upload_location, FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS);

    $destination = $this->fileSystem->getDestinationFilename("{$upload_location}/{$filename}", FileSystemInterface::EXISTS_RENAME);

    // Begin building file entity.
    $values = [
      'uid' => $this->currentUser->id(),
      'status' => 0,
      'filename' => $filename,
      'uri' => $destination,
      'filesize' => $file->getSize(),
      'filemime' => $mime,
    ];

    $storage = $this->entityTypeManager->getStorage('file');
    /** @var \Drupal\file\FileInterface $entity */
    $entity = $storage->create($values);

    // Validate the file name length.
    if ($errors = file_validate($entity, ['file_validate_name_length' => []])) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
        $this->t('The specified file %name could not be uploaded.', [
          '%file' => $filename,
        ]),
      ]);
    }

    // Validate allowed extensions.
    if ($file_element['#file_extensions']) {
      $allowed_extensions = $file_element['#file_extensions'];
    }
    else {
      $file_type = str_replace('webform_', '', $file_element['#type']);
      $allowed_extensions = \Drupal::config('webform.settings')->get("file.default_{$file_type}_extensions");
    }
    $errors = file_validate_extensions($entity, $allowed_extensions);
    if ($errors) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, $errors);
    }

    // Move uploaded files from PHP's upload_tmp_dir to Drupal's temporary
    // directory. This overcomes open_basedir restrictions for future file
    // operations.
    if (!$this->fileSystem->moveUploadedFile($file->getRealPath(), $entity->getFileUri())) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, NULL, [
        $this->t('Could not move uploaded file %name.', [
          '%file' => $file->getFilename(),
        ]),
      ]);
    }

    // Set the permissions on the new file.
    $this->fileSystem->chmod($entity->getFileUri());

    // Update the filename with any changes as a result of security or renaming
    // due to an existing file.
    $entity->setFilename(\Drupal::service('file_system')->basename($destination));

    // Validate the entity values.
    if (($violations = $entity->validate()) && $violations->count()) {
      return new WebformFileUploadOutputWrapper(NULL, NULL, $violations);
    }

    // If we reached this point, we can save the file.
    if (($status = $entity->save()) && $status === SAVED_NEW) {
      return new WebformFileUploadOutputWrapper($entity, $entity->id(), NULL, []);
    }

    return NULL;
  }

}
