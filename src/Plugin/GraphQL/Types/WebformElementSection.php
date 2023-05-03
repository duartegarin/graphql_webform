<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\WebformSection;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for section form items.
 *
 * @GraphQLType(
 *   id = "webform_element_section",
 *   name = "WebformElementSection",
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementSection extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof WebformSection;
  }

}
