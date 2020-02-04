<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the submit label property from Actions form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementActions"},
 *   id = "webform_element_submit_label",
 *   name = "submitLabel",
 *   type = "String",
 * )
 */
class WebformElementSubmitLabel extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#submit__label'])) {
      yield $value['#submit__label'];
    }
  }

}
