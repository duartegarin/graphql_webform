<?php

namespace Drupal\graphql_webform_states\Plugin\Deriver;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\graphql\Utility\StringHelper;

/**
 * Deriver for webform element states.
 */
class WebformStatesDeriver extends DeriverBase {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($basePluginDefinition) {
    $fields = [
      'visible',
      'invisible',
      'visible_slide',
      'invisible_slide',
      'enabled',
      'disabled',
      'readwrite',
      'readonly',
      'expanded',
      'collapsed',
      'required',
      'optional',
      'checked',
      'unchecked',
    ];

    foreach ($fields as $field) {
      $derivative = [
        'id' => $field,
        'name' => StringHelper::propCase($field),
        'type' => 'WebformElementState',
        'parents' => ['WebformElementStates'],
      ] + $basePluginDefinition;
      $this->derivatives[$field] = $derivative;
    }
    return parent::getDerivativeDefinitions($basePluginDefinition);
  }

}
