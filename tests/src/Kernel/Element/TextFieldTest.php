<?php

declare(strict_types = 1);

namespace Drupal\Tests\graphql_webform\Kernel\Element;

use Drupal\Tests\graphql_webform\Kernel\GraphQLWebformKernelTestBase;

/**
 * Tests for the WebformElementTextField type.
 *
 * @group graphql_webform
 */
class TextFieldTest extends GraphQLWebformKernelTestBase {

  /**
   * Tests the text fields.
   */
  public function testTextFields(): void {
    $query = $this->getQueryFromFile('textfield.gql');
    $this->assertResults($query, ['webform_id' => 'graphql_webform_test_form'], [
      'form' => [
        'title' => 'GraphQL Webform test form',
        'elements' => [
          0 => [
            '__typename' => 'WebformElementTextField',
            'id' => 'required_text_field',
            'title' => 'Required text field',
            'description' => 'The description of the required text field.',
            'required' => [
              'message' => 'This is important.',
            ],
          ],
          1 => [
            '__typename' => 'WebformElementTextField',
            'id' => 'optional_text_field',
            'title' => 'Optional text field',
            'description' => NULL,
            'required' => NULL,
          ],
        ],
      ],
    ], $this->defaultCacheMetaData());
  }

}
