<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;
use Drupal\Core\Render\Element;

/**
 * A field that represents all the form elements in a Webform.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"Webform"},
 *   id = "webform_elements",
 *   name = "elements",
 *   type = "[JsonObject]",
 * )
 */
class WebformElements extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {

    $element_ids = Element::children($value['elements']);

    foreach ($element_ids as $element_id) {
      $json_object = $value['elements'][$element_id];
      $json_object['type'] = 'JsonObject';
      yield $json_object;
    }
  }

}
