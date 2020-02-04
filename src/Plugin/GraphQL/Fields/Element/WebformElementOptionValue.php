<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve option value of a OptionsBase form item.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementOption"},
 *   id = "webform_element_option_value",
 *   name = "value",
 *   type = "String",
 * )
 */
class WebformElementOptionValue extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['value'];
  }

}
