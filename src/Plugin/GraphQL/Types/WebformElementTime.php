<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\WebformTime;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for date form item.
 *
 * @GraphQLType(
 *   id = "webform_element_time",
 *   name = "WebformElementTime",
 *   interfaces = {"WebformElementTimeBase"},
 * )
 */
class WebformElementTime extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof WebformTime;
  }

}
