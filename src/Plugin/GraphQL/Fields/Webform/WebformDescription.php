<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Webform;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the webform description.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"Webform"},
 *   id = "webform_description",
 *   name = "description",
 *   type = "String",
 * )
 */
class WebformDescription extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['webform']->getDescription();
  }

}
