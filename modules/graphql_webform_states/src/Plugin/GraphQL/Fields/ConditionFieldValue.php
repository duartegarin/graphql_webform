<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The actual value that the field (element ID) must be validated against.
 *
 * The value is derived from the selector and falls back to the value defined
 * by webform. For example, if the condition is triggered against a checkbox of
 * a multiple checkbox element, the fieldValue will resolve to the value of
 * this checkbox. The selector might look like this:
 *
 * :input[name="select_topics[checkboxes][Security]"]
 *
 * That means that fieldValue should be "Security", so that we can validate
 * against the field "select_topics" if the trigger is VALUE_IS.
 *
 * @GraphQLField(
 *   id = "webform_element_state_condition_field_value",
 *   parents = {"WebformElementStateCondition"},
 *   name = "fieldValue",
 *   type = "String",
 * )
 */
class ConditionFieldValue extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $condition_value = $value['value'] ?? '';
    $selector = $value['selector'] ?? '';
    $matches = [];
    preg_match('/:input\[name=".*\[(.*)]"/', $selector, $matches);

    yield $matches[1] ?? $condition_value;
  }

}
