<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Mutations;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Mutations\MutationPluginBase;
use Drupal\graphql_webform\GraphQL\WebformSubmissionOutputWrapper;
use Drupal\webform\WebformSubmissionForm;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Drupal\webform\Entity\Webform;
use Drupal\Core\Render\RenderContext;
use Drupal\Core\Render\RendererInterface;

/**
 * A test mutation.
 *
 * @GraphQLMutation(
 *   id = "submit_form",
 *   secure = true,
 *   name = "submitForm",
 *   type = "WebformSubmissionOutput",
 *   arguments = {
 *     "values" = "String!"
 *   }
 * )
 */
class SubmitForm extends MutationPluginBase implements ContainerFactoryPluginInterface {

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $pluginId, $pluginDefinition) {
    return new static(
      $configuration,
      $pluginId,
      $pluginDefinition,
      $container->get('renderer')
    );
  }

  /**
   * EntityRendered constructor.
   *
   * @param array $configuration
   *   The plugin configuration array.
   * @param string $pluginId
   *   The plugin id.
   * @param mixed $pluginDefinition
   *   The plugin definition.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   *
   * @codeCoverageIgnore
   */
  public function __construct(
    array $configuration,
    $pluginId,
    $pluginDefinition,
    RendererInterface $renderer
  ) {
    parent::__construct($configuration, $pluginId, $pluginDefinition);
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public function resolve($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $values = json_decode($args['values'], TRUE);

    $webform_id = $values['webform_id'];
    if (empty($webform_id)) {
      return new WebformSubmissionOutputWrapper(NULL, [
        'Missing webform_id',
      ]);
    }

    $webform = Webform::load($webform_id);
    if (!$webform) {
      return new WebformSubmissionOutputWrapper(NULL, [
        'Invalid webform_id',
      ]);
    }

    $is_open = WebformSubmissionForm::isOpen($webform);
    if (!$is_open) {
      return new WebformSubmissionOutputWrapper(NULL, [
        'Webform is closed for new submissions.',
      ]);
    }

    $renderContext = new RenderContext();

    $result = $this->renderer->executeInRenderContext($renderContext, function () use ($values) {
      $webform_data['webform_id'] = $values['webform_id'];
      unset($values['webform_id']);
      $webform_data['data'] = $values;

      // Validate submission.
      $errors = WebformSubmissionForm::validateFormValues($webform_data);

      if (!empty($errors)) {
        return $this->resolveOutput(NULL, $errors);
      }

      $webform_submission = WebformSubmissionForm::submitFormValues($webform_data);
      return $this->resolveOutput($webform_submission);
    });

    if (!$renderContext->isEmpty()) {
      $context->addCacheableDependency($renderContext->pop());
    }

    return $result;

  }

  /**
   * Formats the output of the mutation.
   *
   * @param \Drupal\webform\WebformSubmissionInterface|null $webform_submission
   *   The created webform submission.
   * @param array $errors
   *   The errors array.
   *
   * @return mixed
   *   The output for the created webform submission.
   */
  protected function resolveOutput($webform_submission, array $errors = []) {
    if (!empty($errors)) {
      return new WebformSubmissionOutputWrapper(NULL, $errors);
    }
    if ($webform_submission) {
      return new WebformSubmissionOutputWrapper($webform_submission, NULL);
    }

    return NULL;
  }

}
