<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve default value property of a form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase",
 *     "WebformElementDateBase",
 *     "WebformElementOptionsBase",
 *     "WebformElementHidden"
 *   },
 *   id = "webform_element_default_value",
 *   name = "defaultValue",
 *   type = "[String]",
 * )
 */
class WebformElementDefaultValue extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#default_value'])) {
      // Multivalued fields.
      if (is_array($value['#default_value'])) {
        foreach ($value['#default_value'] as $default_value) {
          yield $default_value;
        }
      }
      else {
        yield $value['#default_value'];
      }
    }
  }

}
