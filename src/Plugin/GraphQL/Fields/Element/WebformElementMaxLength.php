<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve max length property from a TextBase form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementTextBase"},
 *   id = "webform_element_max_length",
 *   name = "maxLength",
 *   type = "Int",
 * )
 */
class WebformElementMaxLength extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#maxlength'])) {
      yield $value['#maxlength'];
    }
  }

}
