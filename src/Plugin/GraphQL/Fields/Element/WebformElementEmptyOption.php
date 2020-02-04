<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the empty label property from a Select form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementSelect"},
 *   id = "webform_element_empty_option",
 *   name = "emptyOption",
 *   type = "WebformElementOption",
 * )
 */
class WebformElementEmptyOption extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $response['title'] = isset($value['#empty_option']) ? $value['#empty_option'] : '';
    $response['value'] = isset($value['#empty_option']) ? $value['#empty_value'] : '';
    $response['type'] = 'WebformElementOption';
    yield $response;
  }

}
