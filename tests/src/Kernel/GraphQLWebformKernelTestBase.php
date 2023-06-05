<?php

declare(strict_types = 1);

namespace Drupal\Tests\graphql_webform\Kernel;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\graphql\GraphQL\Execution\QueryResult;
use Drupal\Tests\graphql\Kernel\GraphQLTestBase;
use GraphQL\Error\Error;
use GraphQL\Server\OperationParams;

/**
 * Base class for GraphQL Webform kernel tests.
 */
class GraphQLWebformKernelTestBase extends GraphQLTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'graphql',
    'graphql_webform',
    'graphql_webform_test',
    'webform',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->installSchema('webform', ['webform']);
    $this->installConfig('graphql_webform_test');
  }

  /**
   * {@inheritdoc}
   */
  protected function assertResults($query, $variables, $expected, CacheableMetadata $metadata): void {
    $result = $this->graphQlProcessor()->processQuery(
      $this->getDefaultSchema(),
      OperationParams::create([
        'query' => $query,
        'variables' => $variables,
      ])
    );

    $this->assertResultErrors($result, []);
    $this->assertResultData($result, $expected);
    $this->assertResultMetadata($result, $metadata);
  }

  /**
   * {@inheritdoc}
   */
  protected function assertResultErrors(QueryResult $result, array $expected): void {
    // Retrieve the list of error strings.
    $errors = array_map(function (Error $error) {
      return $error->getMessage();
    }, $result->errors);

    // Initalize the status.
    $unexpected = [];
    $matchCount = array_map(function () {
      return 0;
    }, array_flip($expected));

    // Iterate through error messages.
    // Collect unmatched errors and count pattern hits.
    while ($error = array_pop($errors)) {
      $match = FALSE;
      foreach ($expected as $pattern) {
        if (@preg_match($pattern, NULL) === FALSE) {
          $match = $match || $pattern == $error;
          $matchCount[$pattern]++;
        }
        else {
          $match = $match || preg_match($pattern, $error);
          $matchCount[$pattern]++;
        }
      }

      if (!$match) {
        $unexpected[] = $error;
      }
    }

    // Create a list of patterns that never matched.
    $missing = array_keys(array_filter($matchCount, function ($count) {
      return $count == 0;
    }));

    $this->assertEquals([], $missing, "Missing errors:\n* " . implode("\n* ", $missing));
    $this->assertEquals([], $unexpected, "Unexpected errors:\n* " . implode("\n* ", $unexpected));
  }

  /**
   * {@inheritdoc}
   */
  protected function assertResultData(QueryResult $result, $expected): void {
    $data = $result->toArray();
    // Filter out empty data sets from the form elements. In our test queries we
    // are using conditional fields. GraphQL returns empty objects for unmatched
    // fields. These are not important for the test results.
    if (!empty($data['data']['form']['elements'])) {
      $elements = &$data['data']['form']['elements'];
      $elements = array_filter($elements, function ($value) {
        return !is_object($value) || !empty((array) $value);
      });
    }

    $this->assertArrayHasKey('data', $data, 'No result data.');
    $this->assertEquals($expected, $data['data'], 'Unexpected query result.');
  }

  /**
   * {@inheritdoc}
   */
  protected function assertResultMetadata(QueryResult $result, CacheableMetadata $expected): void {
    $this->assertEquals($expected->getCacheMaxAge(), $result->getCacheMaxAge(), 'Unexpected cache max age.');

    $missingContexts = array_diff($expected->getCacheContexts(), $result->getCacheContexts());
    $this->assertEmpty($missingContexts, 'Missing cache contexts: ' . implode(', ', $missingContexts));

    $unexpectedContexts = array_diff($result->getCacheContexts(), $expected->getCacheContexts());
    $this->assertEmpty($unexpectedContexts, 'Unexpected cache contexts: ' . implode(', ', $unexpectedContexts));

    $missingTags = array_diff($expected->getCacheTags(), $result->getCacheTags());
    $this->assertEmpty($missingTags, 'Missing cache tags: ' . implode(', ', $missingTags));

    $unexpectedTags = array_diff($result->getCacheTags(), $expected->getCacheTags());
    $this->assertEmpty($unexpectedTags, 'Unexpected cache tags: ' . implode(', ', $unexpectedTags));
  }

  /**
   * {@inheritdoc}
   */
  protected function defaultCacheTags() {
    return [
      'config:webform.settings',
      'config:webform.webform.graphql_webform_test_form',
      'graphql',
      'webform:graphql_webform_test_form',
    ];
  }

}
