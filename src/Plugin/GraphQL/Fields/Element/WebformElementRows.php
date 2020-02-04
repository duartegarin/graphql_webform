<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the rows property from a Textarea form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementTextarea"},
 *   id = "webform_element_rows",
 *   name = "rows",
 *   type = "Int",
 * )
 */
class WebformElementRows extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#rows'])) {
      yield $value['#rows'];
    }
  }

}
