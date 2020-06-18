<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\Component\Utility\Bytes;
use Drupal\Component\Utility\Environment;
use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve the empty label property from a Select form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformElementManagedFileBase"},
 *   id = "webform_element_max_filesize",
 *   name = "maxFilesize",
 *   type = "String",
 * )
 */
class WebformElementMaxFilesize extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if (isset($value['#max_filesize'])) {
      yield $value['#max_filesize'];
    }
    else {
      $max_filesize = \Drupal::config('webform.settings')->get('file.default_max_filesize') ?: Environment::getUploadMaxSize();
      $max_filesize = Bytes::toInt($max_filesize);
      $max_filesize = ($max_filesize / 1024 / 1024);
      yield $max_filesize;
    }
  }

}
