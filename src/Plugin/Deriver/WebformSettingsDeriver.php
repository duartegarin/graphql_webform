<?php

namespace Drupal\graphql_webform\Plugin\Deriver;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\graphql\Utility\StringHelper;
use Drupal\webform\Entity\Webform;

/**
 * Deriver for webform settings.
 *
 * The default settings of the Webform entity are used to derive possible
 * settings fields.
 */
class WebformSettingsDeriver extends DeriverBase {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($basePluginDefinition) {
    $default_settings = Webform::getDefaultSettings();

    // Some settings have a default value of NULL, so we need to map these
    // manually.
    $null_settings = [
      'ajax_speed' => 'Int',
      'limit_total' => 'Int',
      'limit_total_interval' => 'Int',
      'limit_user' => 'Int',
      'limit_user_interval' => 'Int',
      'entity_limit_total' => 'Int',
      'entity_limit_total_interval' => 'Int',
      'entity_limit_user' => 'Int',
      'entity_limit_user_interval' => 'Int',
      'purge_days' => 'Int',
    ];

    foreach ($default_settings as $prop => $value) {
      $type = $null_settings[$prop] ?? $this->getType($value);
      if ($type) {
        $derivative = [
          'id' => $prop,
          'name' => StringHelper::propCase($prop),
          'type' => $type,
          'parents' => ['WebformSettings'],
        ] + $basePluginDefinition;
        $this->derivatives[$prop] = $derivative;
      }
    }
    return parent::getDerivativeDefinitions($basePluginDefinition);
  }

  /**
   * Get the GraphQL type for a PHP type.
   *
   * @var mixed $value
   *   The value to get the type for.
   *
   * @return string|null
   *   The GraphQL type.
   */
  private function getType($value) {
    switch (gettype($value)) {
      case 'boolean':
        return 'Boolean';
      case 'integer':
        return 'Int';
      case 'double':
        return 'Float';
      case 'string':
        return 'String';
    }

    return NULL;
  }
}
