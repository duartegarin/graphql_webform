<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\WebformFlexbox;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for flexbox elements.
 *
 * @GraphQLType(
 *   id = "webform_element_flexbox",
 *   name = "WebformElementFlexbox",
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementFlexbox extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof WebformFlexbox;
  }

}
