<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve min length property from a TextBase form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementNumber"},
 *   id = "webform_element_min",
 *   name = "min",
 *   type = "Int",
 * )
 */
class WebformElementMin extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#min'])) {
      yield $value['#min'];
    }
  }

}
