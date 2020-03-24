<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for a value/title option of OptionsBase form item.
 *
 * @GraphQLType(
 *   id = "webform_element_validation_multiple",
 *   name = "WebformElementValidationMultiple",
 * )
 */
class WebformElementValidationMultiple extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['type'] == 'WebformElementValidationMultiple';
  }

}
