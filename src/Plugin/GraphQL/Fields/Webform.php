<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A field that represents a single Webform.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformResult"},
 *   id = "webform",
 *   name = "webform",
 *   type = "Webform",
 * )
 */
class Webform extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['Webform'];
  }

}
