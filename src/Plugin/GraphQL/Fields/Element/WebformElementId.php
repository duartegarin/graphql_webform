<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the form element machine name.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElement"},
 *   id = "webform_element_id",
 *   name = "id",
 *   type = "String",
 * )
 */
class WebformElementId extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['#id'];
  }

}
