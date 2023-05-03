<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The trigger of the condition.
 *
 * @GraphQLField(
 *   id = "webform_element_state_condition_trigger",
 *   parents = {"WebformElementStateCondition"},
 *   name = "trigger",
 *   type = "WebformStateConditionTrigger",
 * )
 */
class ConditionTrigger extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['trigger'] ?? NULL;
  }

}
