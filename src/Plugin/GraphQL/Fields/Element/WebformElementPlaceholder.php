<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the placeholder property from a TextBase form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementTextBase"},
 *   id = "webform_element_placeholder",
 *   name = "placeholder",
 *   type = "String",
 * )
 */
class WebformElementPlaceholder extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#placeholder'])) {
      yield $value['#placeholder'];
    }
  }

}
