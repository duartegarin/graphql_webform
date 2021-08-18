<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\webform\Element\WebformEntitySelect;
use Drupal\webform\Entity\WebformOptions;
use Drupal\webform\Plugin\WebformElement\Radios;
use Drupal\webform\Plugin\WebformElement\Select;
use GraphQL\Type\Definition\ResolveInfo;
use Drupal\webform\Element\WebformTermSelect;
use Drupal\webform\Plugin\WebformElement\WebformTermSelect as WebformTermSelectPlugin;
use Drupal\webform\Plugin\WebformElement\WebformEntitySelect as WebformEntitySelectPlugin;

/**
 * Retrieve options property from a OptionsBase form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementOptionsBase"},
 *   id = "webform_element_options",
 *   name = "options",
 *   type = "[WebformElementOption]",
 * )
 */
class WebformElementOptions extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {

    if (isset($value['#disabled']) && $value['#disabled'] == TRUE) {
      return;
    }

    if (!isset($value['#options'])) {
      $value['#options'] = [];

      if ($value['plugin'] instanceof WebformTermSelectPlugin) {
        if (!isset($value['#vocabulary'])) {
          $element_info = $value['plugin']->getInfo();
          $value['#vocabulary'] = isset($element_info['#vocabulary']) ? $element_info['#vocabulary'] : '';
        }

        if (!empty($value['#vocabulary'])) {
          WebformTermSelect::setOptions($value);
        }
      }
      elseif ($value['plugin'] instanceof WebformEntitySelectPlugin) {
        WebformEntitySelect::setOptions($value);
      }
    }
    else {
      // Handle predefined options.
      if (is_string($value['#options']) && ($value['plugin'] instanceof Select || $value['plugin'] instanceof Radios)) {
        $value['#options'] = WebformOptions::getElementOptions($value);
      }
    }

    foreach ($value['#options'] as $value => $title) {
      $response['title'] = $title;
      $response['value'] = $value;
      $response['type'] = 'WebformElementOption';
      yield $response;
    }
  }

}
