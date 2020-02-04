<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A field that represents all the form elements in a Webform.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElement"},
 *   id = "webform_element_type",
 *   name = "type",
 *   type = "String",
 * )
 */
class WebformElementType extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['#type'];
  }

}
