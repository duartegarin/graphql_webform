<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Webform;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the webform title.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"Webform"},
 *   id = "webform_title",
 *   name = "title",
 *   type = "String",
 * )
 */
class WebformTitle extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['webform']->label();
  }

}
