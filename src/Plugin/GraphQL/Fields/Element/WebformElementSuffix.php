<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve suffix property from the form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase",
 *     "WebformElementOptionsBase",
 *     "WebformElementManagedFileBase",
 *     "WebformElementDateBase",
 *     "WebformElementComposite",
 *     "WebformElementNumber"
 *   },
 *   id = "webform_element_suffix",
 *   name = "suffix",
 *   type = "String",
 * )
 */
class WebformElementSuffix extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#field_suffix'])) {
      yield $value['#field_suffix'];
    }
  }

}
