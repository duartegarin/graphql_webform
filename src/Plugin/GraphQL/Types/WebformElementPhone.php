<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Telephone;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for textfield form item.
 *
 * @GraphQLType(
 *   id = "webform_element_phone",
 *   name = "WebformElementPhone",
 *   interfaces = {"WebformElementTextBase"},
 * )
 */
class WebformElementPhone extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Telephone;
  }

}
