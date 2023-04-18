<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Interfaces;

use Drupal\graphql\Plugin\GraphQL\Interfaces\InterfacePluginBase;

/**
 * GraphQL interface for Time form elements.
 *
 * @GraphQLInterface(
 *   id = "webform_element_time_base",
 *   name = "WebformElementTimeBase",
 *   description = @Translation(""),
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementTimeBase extends InterfacePluginBase {

}
