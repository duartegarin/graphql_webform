<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * The logic operator of a element state.
 *
 * @GraphQLField(
 *   id = "webform_element_state_logic",
 *   parents = {"WebformElementState"},
 *   name = "logic",
 *   type = "WebformStateLogic",
 * )
 */
class StateLogic extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['logic'];
  }

}
