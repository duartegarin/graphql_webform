<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Submission;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\graphql_webform\GraphQL\WebformSubmissionOutputWrapper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the form element machine name.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformSubmissionOutput"},
 *   id = "webform_submission_output_errors",
 *   name = "errors",
 *   type = "[String]",
 * )
 */
class WebformSubmissionOutputErrors extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if ($value instanceof WebformSubmissionOutputWrapper) {
      if ($errors = $value->getErrors()) {
        foreach ($errors as $error) {
          yield $error;
        }
      }
    }
  }

}
