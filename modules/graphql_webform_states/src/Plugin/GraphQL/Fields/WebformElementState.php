<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Fields;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\webform\Utility\WebformArrayHelper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Get the logic and conditions of a webform element state.
 *
 * @GraphQLField(
 *   id = "webform_element_state",
 *   parents = {"WebformElementStates"},
 *   deriver = "Drupal\graphql_webform_states\Plugin\Deriver\WebformStatesDeriver",
 * )
 */
class WebformElementState extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $definition = $this->getPluginDefinition();
    $field = str_replace('_', '-', $definition['id']);
    $state = $value[$field] ?? NULL;

    if ($state) {
      $logic = $this->getConditionLogic($state);
      $conditions = $this->getConditions($state);

      if (!empty($conditions)) {
        yield [
          'logic' => $logic,
          'conditions' => $conditions,
        ];
      }
    }
  }

  /**
   * Determine the condition logic.
   *
   * @param array $conditions
   *   The webform conditions array.
   *
   * @return string
   *   The logic.
   */
  private function getConditionLogic($conditions) {
    if ($conditions && WebformArrayHelper::isSequential($conditions)) {
      if (in_array('xor', $conditions)) {
        return 'xor';
      }
      else if (in_array('or', $conditions)) {
        return 'or';
      }
    }

    return 'and';
  }

  /**
   * Map the conditions.
   *
   * The conditions can either be an array with selectors as keys or a
   * sequential array that contains both conditions and strings indicating the
   * logic ('or', 'and', 'xor').
   *
   * @param array $definition
   *   The conditions array from the webform element.
   *
   * @return array
   *   The mapped, sequential array of conditions.
   */
  private function getConditions($definition) {
    if (!$definition) {
      return [];
    }

    $conditions = [];

    foreach ($definition as $index => $value) {
      // Skip and, or, and xor.
      if (is_string($value) && in_array($value, ['and', 'or', 'xor'])) {
        continue;
      }

      $selector = NULL;
      $condition = NULL;

      if (is_int($index)) {
        $selector = key($value);
        $condition = $value[$selector];
      }
      else {
        $selector = $index;
        $condition = $value;
      }

      $conditions[] = [
        'selector' => $selector,
        'trigger' => array_key_first($condition),
        'value' => (string) array_values($condition)[0],
      ];
    }

    return $conditions;
  }
}
