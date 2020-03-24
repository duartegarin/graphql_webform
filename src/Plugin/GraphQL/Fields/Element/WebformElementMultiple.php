<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the form element machine name.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase",
 *     "WebformElementDateBase",
 *     "WebformElementOptionsBase",
 *     "WebformElementManagedFileBase",
 *     "WebformElementComposite"
 *   },
 *   id = "webform_element_multiple",
 *   name = "multiple",
 *   type = "WebformElementValidationMultiple",
 * )
 */
class WebformElementMultiple extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {

    $multiple = $value['plugin']->hasMultipleValues($value);

    if ($multiple) {
      $response['limit'] = $multiple;
      if (isset($value['#multiple_error'])) {
        $response['message'] = $value['#multiple_error'];
      }
      $response['type'] = 'WebformElementValidationMultiple';
      yield $response;
    }
  }

}
