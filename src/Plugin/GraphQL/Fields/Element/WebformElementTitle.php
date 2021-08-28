<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the title property from a form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {
 *     "WebformElementTextBase",
 *     "WebformElementActions",
 *     "WebformElementOptionsBase",
 *     "WebformElementManagedFileBase",
 *     "WebformElementDateBase",
 *     "WebformElementComposite",
 *     "WebformElementNumber",
 *     "WebformElementRating"
 *   },
 *   id = "webform_element_title",
 *   name = "title",
 *   type = "String",
 * )
 */
class WebformElementTitle extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    yield $value['#title'];
  }

}
