<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The value of the condition.
 *
 * Note that this is the raw value specified by webform, which might not be the
 * expected value.
 *
 * For example, if a condition is made against a single checkbox of a multiple
 * checkbox element, then the value returned here will be '1', because the
 * desired checkbox is defined in the selector.
 *
 * Use 'fieldValue' to get the expected value.
 *
 * @GraphQLField(
 *   id = "webform_element_state_condition_value",
 *   parents = {"WebformElementStateCondition"},
 *   name = "value",
 *   type = "String",
 * )
 */
class ConditionValue extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['value'] ?? '';
  }

}
