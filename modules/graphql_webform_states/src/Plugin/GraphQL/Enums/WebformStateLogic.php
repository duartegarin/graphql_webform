<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Enums;

use Drupal\graphql\Plugin\GraphQL\Enums\EnumPluginBase;

/**
 * Webform state logic options.
 *
 * @GraphQLEnum(
 *   id = "webform_state_logic",
 *   name = "WebformStateLogic",
 *   values = {
 *     "AND" = "and",
 *     "XOR" = "xor",
 *     "OR" = "or",
 *   }
 * )
 */
class WebformStateLogic extends EnumPluginBase {

}
