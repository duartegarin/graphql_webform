<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Interfaces;

use Drupal\graphql\Plugin\GraphQL\Interfaces\InterfacePluginBase;

/**
 * GraphQL interface for File form elements.
 *
 * @GraphQLInterface(
 *   id = "webform_element_managed_file_base",
 *   name = "WebformElementManagedFileBase",
 *   description = @Translation(""),
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementManagedFileBase extends InterfacePluginBase {

}
