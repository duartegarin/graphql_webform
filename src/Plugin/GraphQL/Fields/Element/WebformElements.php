<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\webform\Entity\Webform;
use Drupal\webform\Plugin\WebformElement\WebformCompositeBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A field that represents all the form elements in a Webform.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "Webform",
 *     "WebformElementComposite",
 *     "WebformElementSection",
 *     "WebformElementContainer",
 *     "WebformElementFlexbox"
 *   },
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
    $elements = $this->getElements($value);

    // By default the webform module adds a submit to the elements but it is not
    // being returned as an element on getElementsDecoded. So, if it's empty,
    // which means that user has not edited the element we force adding the
    // element here.
    if ($value instanceof Webform) {
      if (!isset($elements['actions'])) {
        $elements['actions'] = [
          '#type' => 'webform_actions',
          '#submit__label' => 'Submit'
        ];
      }
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

  /**
   * Get the elements of the webform or of a form element.
   *
   * @param \Drupal\webform\Entity\Webform|array $value
   *   The var to get the elements of.
   *
   * @return array
   *   The elements.
   */
  private function getElements($value) {
    if ($value instanceof Webform) {
      $elements = $value->getElementsDecoded();
      $value->applyVariants(NULL, $elements);
      return $value->getElementsDecoded();
    }

    $plugin = $value['plugin'];
    if ($plugin instanceof WebformCompositeBase) {
      return $plugin->getCompositeElements();
    }

    $elements = [];

    foreach ($value as $key => $value) {
      if ($key[0] !== '#' && $key !== 'plugin') {
        $elements[$key] = $value;
      }
    }

    return $elements;
  }

}
