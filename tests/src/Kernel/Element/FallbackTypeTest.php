<?php

declare(strict_types = 1);

namespace Drupal\Tests\graphql_webform\Kernel\Element;

use Drupal\graphql\GraphQL\Execution\QueryResult;
use Drupal\Tests\graphql_webform\Kernel\GraphQLWebformKernelTestBase;

/**
 * Tests for the WebformElementType type.
 *
 * This is a fallback for all unsupported element types.
 *
 * @group graphql_webform
 */
class FallbackTypeTest extends GraphQLWebformKernelTestBase {

  /**
   * Tests the fallback for unsupported element types.
   */
  public function testFallbackType(): void {
    $query = $this->getQueryFromFile('fallback_type.gql');
    $this->assertResults($query, ['webform_id' => 'graphql_webform_test_form'], [
      'form' => [
        'title' => 'GraphQL Webform test form',
        'elements' => [
          3 => [
            '__typename' => 'WebformElementType',
            'id' => 'unsupported_field',
            'type' => 'webform_height',
          ],
        ],
      ],
    ], $this->defaultCacheMetaData());
  }

  /**
   * {@inheritdoc}
   */
  protected function assertResultData(QueryResult $result, $expected): void {
    $data = $result->toArray();

    // Since we have no other conditional fields, everything will be returned as
    // a fallback type. Unset everything but the actual unsupported element.
    $elements = &$data['data']['form']['elements'];
    $elements = array_slice($elements, 3, 1, TRUE);

    $result = new QueryResult($data['data'], $data['errors'] ?? [], $data['extensions'] ?? []);
    parent::assertResultData($result, $expected);
  }

}
