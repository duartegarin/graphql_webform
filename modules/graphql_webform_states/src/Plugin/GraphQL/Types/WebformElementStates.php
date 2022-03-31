<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * States of a webform element.
 *
 * @GraphQLType(
 *   id = "webform_element_states",
 *   name = "WebformElementStates",
 * )
 */
class WebformElementStates extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return TRUE;
  }

}
