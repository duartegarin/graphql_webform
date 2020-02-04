<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve date max property from Date form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementDateBase"},
 *   id = "webform_element_date_max",
 *   name = "dateMax",
 *   type = "String",
 * )
 */
class WebformElementDateMax extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#date_date_max'])) {
      yield date("Y-m-d", strtotime($value['#date_date_max']));
    }
  }

}
