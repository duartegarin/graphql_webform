<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Interfaces;

use Drupal\graphql\Plugin\GraphQL\Interfaces\InterfacePluginBase;

/**
 * GraphQL interface for Options form elements (Select, Radio, Checkbox, etc).
 *
 * @GraphQLInterface(
 *   id = "webform_element_options_base",
 *   name = "WebformElementOptionsBase",
 *   description = @Translation(""),
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementOptionsBase extends InterfacePluginBase {

}
