<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\WebformRating;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for rating form item.
 *
 * @GraphQLType(
 *   id = "webform_element_rating",
 *   name = "WebformElementRating",
 *   interfaces = {"WebformElement"},
 * )
 */
class WebformElementRating extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof WebformRating;
  }

}
