<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\graphql_webform\GraphQL\WebformSubmissionOutputWrapper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for a WebformSubmissionOutputWrapper object.
 *
 * @GraphQLType(
 *   id = "webform_submission_output",
 *   name = "WebformSubmissionOutput"
 * )
 */
class WebformSubmissionOutput extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return ($object instanceof WebformSubmissionOutputWrapper);
  }

}
