<?php

namespace Drupal\graphql_webform\GraphQL;

use Drupal\webform\Entity\WebformSubmission;

/**
 * A helper class to wrap submission and errors when using submitForm mutation.
 */
class WebformSubmissionOutputWrapper {

  /**
   * The created webform submission.
   *
   * @var \Drupal\webform\Entity\WebformSubmission|null
   */
  protected $submission;

  /**
   * An array of error messages.
   *
   * @var array|null
   */
  protected $errors;

  /**
   * WebformSubmissionOutputWrapper constructor.
   *
   * @param \Drupal\webform\Entity\WebformSubmission|null $submission
   *   The webform submission object that has been created or NULL if failed.
   * @param array|null $errors
   *   An array of validation error messages.
   */
  public function __construct(
    WebformSubmission $submission = NULL,
    array $errors = NULL
  ) {
    $this->submission = $submission;
    $this->errors = $errors;
  }

  /**
   * Returns the entity that was created.
   *
   * @return \Drupal\webform\Entity\WebformSubmission|null
   *   The created webform submission object or NULL if failed.
   */
  public function getSubmission() {
    return $this->submission;
  }

  /**
   * Returns a list of error messages that occurred during submission creation.
   *
   * @return array|null
   *   An array of error messages as plain strings.
   */
  public function getErrors() {
    return $this->errors;
  }

}
