<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Checkbox;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for checkbox form item.
 *
 * @GraphQLType(
 *   id = "webform_element_checkbox",
 *   name = "WebformElementCheckbox",
 *   interfaces = {"WebformElement"},
 * )
 */
class WebformElementCheckbox extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Checkbox;
  }

}
