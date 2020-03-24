<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the required error property from a form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementValidationRequired",
 *     "WebformElementValidationPattern",
 *     "WebformElementValidationMultiple",
 *   },
 *   id = "webform_element_validation_message",
 *   name = "message",
 *   type = "String",
 * )
 */
class WebformElementValidationMessage extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (!empty($value['message'])) {
      yield $value['message'];
    }
  }

}
