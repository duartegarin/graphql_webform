<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the required property from a form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase",
 *     "WebformElementDateBase",
 *     "WebformElementOptionsBase",
 *     "WebformElementManagedFileBase",
 *     "WebformElementNumber",
 *     "WebformElementRating"
 *   },
 *   id = "webform_element_required",
 *   name = "required",
 *   type = "WebformElementValidationRequired",
 * )
 */
class WebformElementRequired extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#required'])) {
      $response['value'] = $value['#required'];
      $response['message'] = isset($value['#required_error']) ? $value['#required_error'] : '';
      $response['type'] = 'WebformElementValidationRequired';
      yield $response;
    }
  }

}
