<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Container;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for container form items.
 *
 * @GraphQLType(
 *   id = "webform_element_container",
 *   name = "WebformElementContainer",
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementContainer extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Container;
  }

}
