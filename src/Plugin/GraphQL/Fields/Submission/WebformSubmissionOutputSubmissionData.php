<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Submission;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\webform\Entity\WebformSubmission;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Provides a field handler which returns webform element data.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformSubmissionEntity"},
 *   id = "webform_submission_output_submission_data",
 *   name = "data",
 *   type = "Any",
 * )
 */
class WebformSubmissionOutputSubmissionData extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if ($value instanceof WebformSubmission) {
      yield $value->getData();
    }
  }

}
