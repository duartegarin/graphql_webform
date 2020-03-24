<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\TextField;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for textfield form item.
 *
 * @GraphQLType(
 *   id = "webform_element_textfield",
 *   name = "WebformElementTextField",
 *   interfaces = {"WebformElementTextBase"},
 * )
 */
class WebformElementTextField extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof TextField;
  }

}
