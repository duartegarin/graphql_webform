<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A Webform element state condition.
 *
 * @GraphQLType(
 *   id = "webform_element_state_condition",
 *   name = "WebformElementStateCondition",
 * )
 */
class WebformElementStateCondition extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return isset($object['selector']) && isset($object['trigger']);
  }

}
