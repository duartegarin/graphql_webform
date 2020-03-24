<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Textarea;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for textarea form item.
 *
 * @GraphQLType(
 *   id = "webform_element_textarea",
 *   name = "WebformElementTextarea",
 *   interfaces = {"WebformElementTextBase"},
 * )
 */
class WebformElementTextarea extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Textarea;
  }

}
