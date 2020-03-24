<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\webform\Plugin\WebformElement\WebformTermSelect;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for select form item.
 *
 * @GraphQLType(
 *   id = "webform_element_term_select",
 *   name = "WebformElementTermSelect",
 *   interfaces = {"WebformElementOptionsBase"},
 * )
 */
class WebformElementTermSelect extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return $object['plugin'] instanceof WebformTermSelect;
  }

}
