<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Number;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for Number form item.
 *
 * @GraphQLType(
 *   id = "webform_element_number",
 *   name = "WebformElementNumber",
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementNumber extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Number;
  }

}
