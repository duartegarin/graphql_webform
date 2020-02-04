<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Interfaces;

use Drupal\graphql\Plugin\GraphQL\Interfaces\InterfacePluginBase;

/**
 * GraphQL interface for TextBase form elements.
 *
 * @GraphQLInterface(
 *   id = "webform_element_text_base",
 *   name = "WebformElementTextBase",
 *   description = @Translation(""),
 *   interfaces = {"WebformElement"}
 * )
 */
class WebformElementTextBase extends InterfacePluginBase {

}
