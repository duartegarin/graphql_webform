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
 *   parents = {"Webform"},
 *   id = "webform_elements",
 *   name = "elements",
 *   type = "[WebformElement]",
 * )
 */
class WebformElements extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    // Load the elements of the webform into a Webform object.
    $elements = $value['webform']->getElementsDecoded();

    foreach ($elements as $id => $element) {
      $element['#id'] = $id;
      $element['type'] = 'WebformElement';
      yield $element;
    }
  }

}
