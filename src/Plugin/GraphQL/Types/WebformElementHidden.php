<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Hidden;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for hidden form item.
 *
 * @GraphQLType(
 *   id = "webform_element_hidden",
 *   name = "WebformElementHidden",
 *   interfaces = {"WebformElement"},
 * )
 */
class WebformElementHidden extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Hidden;
  }

}
