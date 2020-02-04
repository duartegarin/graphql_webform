<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for non-supported form items.
 *
 * This type is needed to avoid errors when the webform contains elements that
 * are not implemented yet.
 *
 * @GraphQLType(
 *   id = "webform_element_type",
 *   name = "WebformElementType",
 *   interfaces = {"WebformElement"},
 * )
 */
class WebformElementType extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    $supported_types = [
      'checkboxes',
      'date',
      'email',
      'managed_file',
      'webform_markup',
      'radios',
      'textarea',
      'textfield',
      'webform_actions',
      'hidden',
      'select',
    ];

    return $object['type'] == 'WebformElement' && !in_array($object['#type'], $supported_types);
  }

}
