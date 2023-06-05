<?php

declare(strict_types = 1);

namespace Drupal\Tests\graphql_webform\Kernel\Element;

use Drupal\Tests\graphql_webform\Kernel\GraphQLWebformKernelTestBase;

/**
 * Tests for the WebformElementTextArea type.
 *
 * @group graphql_webform
 */
class TextAreaTest extends GraphQLWebformKernelTestBase {

  /**
   * Tests the text area.
   */
  public function testTextArea(): void {
    $query = $this->getQueryFromFile('textarea.gql');
    $this->assertResults($query, ['webform_id' => 'graphql_webform_test_form'], [
      'form' => [
        'title' => 'GraphQL Webform test form',
        'elements' => [
          4 => [
            '__typename' => 'WebformElementTextarea',
            'id' => 'textarea',
            'title' => 'Textarea',
            'description' => 'Tell us a bit more about yourself.',
          ],
        ],
      ],
    ], $this->defaultCacheMetaData());
  }

}
