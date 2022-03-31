<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the markup property of a Markup/Basic HTML element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementMarkup"},
 *   id = "webform_element_markup",
 *   name = "markup",
 *   type = "String",
 * )
 */
class WebformElementMarkup extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['#markup'] ?? $value['#text'] ?? '';
  }

}
