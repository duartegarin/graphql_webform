<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Date;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for date form item.
 *
 * @GraphQLType(
 *   id = "webform_element_date",
 *   name = "WebformElementDate",
 *   interfaces = {"WebformElementDateBase"},
 * )
 */
class WebformElementDate extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Date;
  }

}
