<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the step property from a DateBase form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementDateBase",
 *     "WebformElementNumber",
 *     "WebformElementRating"
 *   },
 *   id = "webform_element_step",
 *   name = "step",
 *   type = "Int",
 * )
 */
class WebformElementStep extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#step'])) {
      yield $value['#step'];
    }
  }

}
