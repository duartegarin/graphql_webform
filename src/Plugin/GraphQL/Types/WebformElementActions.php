<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for webform_actions form item.
 *
 * @GraphQLType(
 *   id = "webform_element_actions",
 *   name = "WebformElementActions",
 *   interfaces = {"WebformElement"},
 * )
 */
class WebformElementActions extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['type'] == 'WebformElement' && $object['#type'] == 'webform_actions';
  }

}
