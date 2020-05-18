<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Entity\WebformSubmission;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for a webform submission entity.
 *
 * @GraphQLType(
 *   id = "webform_submission_test",
 *   name = "WebformSubmissionEntity",
 *   interfaces = {"WebformSubmission"}
 * )
 */
class WebformSubmissionEntity extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return ($object instanceof WebformSubmission);
  }

}
