<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve options property from a OptionsBase form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementOptionsBase"},
 *   id = "webform_element_options",
 *   name = "options",
 *   type = "[WebformElementOption]",
 * )
 */
class WebformElementOptions extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#options'])) {
      foreach ($value['#options'] as $value => $title) {
        $response['title'] = $title;
        $response['value'] = $value;
        $response['type'] = 'WebformElementOption';
        yield $response;
      }
    }
  }

}
