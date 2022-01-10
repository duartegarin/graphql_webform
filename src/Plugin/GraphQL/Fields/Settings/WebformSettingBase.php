<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Settings;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL field for webform settings.
 *
 * @GraphQLField(
 *   id = "webform_setting_base",
 *   parents = {"WebformSettings"},
 *   deriver = "Drupal\graphql_webform\Plugin\Deriver\WebformSettingsDeriver",
 * )
 */
class WebformSettingBase extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    $definition = $this->getPluginDefinition();
    $field = $definition['id'];
    yield $value[$field] ?? NULL;
  }

}
