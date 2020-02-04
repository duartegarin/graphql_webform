<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve date min property from Date form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementDateBase"},
 *   id = "webform_element_date_min",
 *   name = "dateMin",
 *   type = "String",
 * )
 */
class WebformElementDateMin extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#date_date_min'])) {
      yield date("Y-m-d", strtotime($value['#date_date_min']));
    }
  }

}
