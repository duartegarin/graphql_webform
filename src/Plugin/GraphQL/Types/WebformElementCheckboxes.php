<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Checkboxes;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for checkboxes form item.
 *
 * @GraphQLType(
 *   id = "webform_element_checkboxes",
 *   name = "WebformElementCheckboxes",
 *   interfaces = {"WebformElementOptionsBase"},
 * )
 */
class WebformElementCheckboxes extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Checkboxes;
  }

}
