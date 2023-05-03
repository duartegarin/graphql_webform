<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The field (aka element ID) the condition is referencing.
 *
 * @GraphQLField(
 *   id = "webform_element_state_condition_field",
 *   parents = {"WebformElementStateCondition"},
 *   name = "field",
 *   type = "String",
 * )
 */
class ConditionField extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $selector = $value['selector'] ?? '';
    $matches = [];
    preg_match('/:input\[name="(.*?)["[]/', $selector, $matches);
    yield $matches[1] ?? NULL;
  }

}
