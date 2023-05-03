<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The conditions of a element state.
 *
 * @GraphQLField(
 *   id = "webform_element_state_conditions",
 *   parents = {"WebformElementState"},
 *   name = "conditions",
 *   type = "[WebformElementStateCondition]",
 * )
 */
class StateConditions extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $conditions = $value['conditions'] ?? [];

    foreach ($conditions as $condition) {
      yield $condition;
    }
  }

}
