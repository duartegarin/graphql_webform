<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Interfaces;

use Drupal\graphql\Plugin\GraphQL\Interfaces\InterfacePluginBase;

/**
 * GraphQL interface for Date form elements.
 *
 * @GraphQLInterface(
 *   id = "webform_element_date_base",
 *   name = "WebformElementDateBase",
 *   description = @Translation(""),
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementDateBase extends InterfacePluginBase {

}
