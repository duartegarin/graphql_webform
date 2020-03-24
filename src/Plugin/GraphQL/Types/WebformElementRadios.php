<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\Radios;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for radios form item.
 *
 * @GraphQLType(
 *   id = "webform_element_radios",
 *   name = "WebformElementRadios",
 *   interfaces = {"WebformElementOptionsBase"},
 * )
 */
class WebformElementRadios extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof Radios;
  }

}
