<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Select;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for select form item.
 *
 * @GraphQLType(
 *   id = "webform_element_select",
 *   name = "WebformElementSelect",
 *   interfaces = {"WebformElementOptionsBase"},
 *   weight = -1
 * )
 */
class WebformElementSelect extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Select;
  }

}
