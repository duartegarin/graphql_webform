<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\File;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\graphql_webform\GraphQL\WebformFileUploadOutputWrapper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Retrieve date max property from Date form element.
 *
 * @GraphQLField(
 *   secure = true,
 *   parents = {"WebformFileUploadOutput"},
 *   id = "webform_file_upload_fid",
 *   name = "fid",
 *   type = "Integer",
 * )
 */
class WebformFileUploadOutputFid extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {
    if ($value instanceof WebformFileUploadOutputWrapper) {
      yield $value->getFid();
    }
  }

}
