<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Settings;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\webform\Entity\Webform;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL field for getting the webform settings.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"Webform"},
 *   id = "webform_settings",
 *   name = "settings",
 *   type = "WebformSettings",
 * )
 */
class WebformSettings extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if ($value instanceof Webform) {
      yield $value->getSettings();
    }
  }

}
