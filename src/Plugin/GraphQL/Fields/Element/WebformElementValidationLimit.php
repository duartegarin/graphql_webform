<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the rule of a form validation (e.g. regex pattern).
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementValidationMultiple"},
 *   id = "webform_element_validation_limit",
 *   name = "limit",
 *   type = "Integer",
 * )
 */
class WebformElementValidationLimit extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (is_int($value['limit'])) {
      yield $value['limit'];
    }
    else {
      yield 0;
    }
  }

}
