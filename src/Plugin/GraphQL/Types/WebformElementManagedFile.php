<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for managed_file form item.
 *
 * @GraphQLType(
 *   id = "webform_element_managed_file",
 *   name = "WebformElementManagedFile",
 *   interfaces = {"WebformElementManagedFileBase"},
 * )
 */
class WebformElementManagedFile extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['type'] == 'WebformElement' && $object['#type'] == 'managed_file';
  }

}
