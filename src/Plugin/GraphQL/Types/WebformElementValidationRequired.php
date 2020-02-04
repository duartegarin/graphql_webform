<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for a pattern rule and error message of a form item.
 *
 * @GraphQLType(
 *   id = "webform_element_validation_required",
 *   name = "WebformElementValidationRequired"
 * )
 */
class WebformElementValidationRequired extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['type'] == 'WebformElementValidationRequired';
  }

}
