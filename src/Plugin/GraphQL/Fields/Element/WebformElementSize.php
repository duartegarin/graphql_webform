<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the size property from a form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase"
 *   },
 *   id = "webform_element_size",
 *   name = "size",
 *   type = "Int",
 * )
 */
class WebformElementSize extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#size'])) {
      yield $value['#size'];
    }
  }

}
