<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the form element description.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase",
 *     "WebformElementOptionsBase",
 *     "WebformElementManagedFileBase",
 *     "WebformElementDateBase",
 *     "WebformElementComposite",
 *     "WebformElementNumber",
 *     "WebformElementRating"
 *   },
 *   id = "webform_element_description",
 *   name = "description",
 *   type = "String",
 * )
 */
class WebformElementDescription extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#description'])) {
      yield $value['#description'];
    }
  }

}
