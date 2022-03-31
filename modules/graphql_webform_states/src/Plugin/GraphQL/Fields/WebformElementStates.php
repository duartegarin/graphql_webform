<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Resolve states of a webform element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElement"},
 *   id = "webform_element_states",
 *   name = "states",
 *   type = "WebformElementStates",
 * )
 */
class WebformElementStates extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['#states'] ?? NULL;
  }

}
