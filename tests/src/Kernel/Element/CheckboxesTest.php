<?php

declare(strict_types = 1);

namespace Drupal\Tests\graphql_webform\Kernel\Element;

use Drupal\Tests\graphql_webform\Kernel\GraphQLWebformKernelTestBase;

/**
 * Tests for the WebformElementCheckboxes type.
 *
 * @group graphql_webform
 */
class CheckboxesTest extends GraphQLWebformKernelTestBase {

  /**
   * Tests the checkboxes.
   */
  public function testCheckboxes(): void {
    $query = $this->getQueryFromFile('checkboxes.gql');
    $this->assertResults($query, ['webform_id' => 'graphql_webform_test_form'], [
      'form' => [
        'title' => 'GraphQL Webform test form',
        'elements' => [
          2 => [
            '__typename' => 'WebformElementCheckboxes',
            'id' => 'checkboxes',
            'title' => 'Checkboxes',
            'description' => 'Choose your moons.',
            'options' => [
              [
                'value' => 'phobos',
                'title' => 'Phobos',
              ],
              [
                'value' => 'deimos',
                'title' => 'Deimos',
              ],
            ],
          ],
        ],
      ],
    ], $this->defaultCacheMetaData());
  }

}
