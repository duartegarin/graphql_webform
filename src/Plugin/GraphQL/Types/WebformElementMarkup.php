<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\WebformMarkupBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for webform_markup form item.
 *
 * @GraphQLType(
 *   id = "webform_element_markup",
 *   name = "WebformElementMarkup",
 *   interfaces = {"WebformElement"},
 * )
 */
class WebformElementMarkup extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof WebformMarkupBase;
  }

}
