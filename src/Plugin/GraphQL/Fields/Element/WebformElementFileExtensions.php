<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the empty label property from a Select form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementManagedFileBase"},
 *   id = "webform_element_file_extensions",
 *   name = "fileExtensions",
 *   type = "String",
 * )
 */
class WebformElementFileExtensions extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#file_extensions'])) {
      yield $value['#file_extensions'];
    }
    else {
      $file_type = str_replace('webform_', '', $value['#type']);
      $file_extensions = \Drupal::config('webform.settings')->get("file.default_{$file_type}_extensions");
      yield $file_extensions;
    }
  }

}
