<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Types;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql\Plugin\GraphQL\Types\TypePluginBase;
use Drupal\graphql_webform\GraphQL\WebformFileUploadOutputWrapper;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A GraphQL type for a WebformFileUploadOutputWrapper object.
 *
 * @GraphQLType(
 *   id = "webform_file_upload_output",
 *   name = "WebformFileUploadOutput",
 *   interfaces = {"EntityCrudOutput"}
 * )
 */
class WebformFileUploadOutput extends TypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function applies($object, ResolveContext $context, ResolveInfo $info) {
    return ($object instanceof WebformFileUploadOutputWrapper);
  }

}
