<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types\Settings;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for webform settings.
 *
 * @GraphQLType(
 *   id = "webform_confirmation_type",
 *   name = "WebformSettings",
 *   weight = -999
 * )
 */
class WebformSettings extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return isset($object['confirmation_type']);
  }

}
