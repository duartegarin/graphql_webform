<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\webform\Entity\Webform;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A field that represents all the form elements in a Webform.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"Webform","WebformElementComposite"},
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

    if ($value instanceof Webform) {
      $elements = $value->getElementsDecoded();
    }
    else {
      $plugin = $value['plugin'];
      $elements = $plugin->getCompositeElements();
    }

    $element_manager = \Drupal::service('plugin.manager.webform.element');

    foreach ($elements as $id => $element) {
      $element_plugin = $element_manager->getElementInstance($element);
      $element['#id'] = $id;
      // This is used to define the type.
      $element['plugin'] = $element_plugin;
      yield $element;
    }
  }

}
