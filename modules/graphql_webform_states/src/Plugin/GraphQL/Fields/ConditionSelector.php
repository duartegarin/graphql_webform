<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The selector of the condition.
 *
 * @GraphQLField(
 *   id = "webform_element_state_condition_selector",
 *   parents = {"WebformElementStateCondition"},
 *   name = "selector",
 *   type = "String",
 * )
 */
class ConditionSelector extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['selector'] ?? '';
  }

}
