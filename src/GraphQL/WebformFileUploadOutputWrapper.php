<?php

namespace Drupal\graphql_webform\GraphQL;

use Drupal\Core\Entity\EntityInterface;
use Drupal\graphql_core\GraphQL\EntityCrudOutputWrapper;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Extends EntityCrudOutputWrapper to add fid (File id) to the helper class.
 */
class WebformFileUploadOutputWrapper extends EntityCrudOutputWrapper {

  /**
   * The created File entity id.
   *
   * @var int|null
   */
  protected $fid;

  /**
   * CreateEntityOutputWrapper constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface|null $entity
   *   The entity object that has been created or NULL if creation failed.
   * @param int $fid
   *   The file id.
   * @param \Symfony\Component\Validator\ConstraintViolationListInterface|null $violations
   *   The validation errors that occurred during creation or NULL if validation
   *   succeeded.
   * @param array|null $errors
   *   An array of non validation error messages. Can be used to provide
   *   additional error messages e.g. for access restrictions.
   */
  public function __construct(
    EntityInterface $entity = NULL,
    int $fid = NULL,
    ConstraintViolationListInterface $violations = NULL,
    array $errors = NULL
  ) {
    parent::__construct($entity, $violations, $errors);
    $this->fid = $fid;
  }

  /**
   * Returns the fid.
   *
   * @return int|null
   *   The file id or NULL if creation failed.
   */
  public function getFid() {
    return $this->fid;
  }

}
