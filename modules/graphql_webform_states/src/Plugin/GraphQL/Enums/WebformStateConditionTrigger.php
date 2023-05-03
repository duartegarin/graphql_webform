<?php

namespace Drupal\graphql_webform_states\Plugin\GraphQL\Enums;

use Drupal\graphql\Plugin\GraphQL\Enums\EnumPluginBase;

/**
 * Webform element state condition triggers.
 *
 * @GraphQLEnum(
 *   id = "webform_state_condition_trigger",
 *   name = "WebformStateConditionTrigger",
 *   values = {
 *     "EMPTY" = "empty",
 *     "FILLED" = "filled",
 *     "CHECKED" = "checked",
 *     "UNCHECKED" = "unchecked",
 *     "VALUE_IS" = "value",
 *     "VALUE_IS_NOT" = "!value",
 *     "PATTERN" = "pattern",
 *     "NOT_PATTERN" = "!pattern",
 *     "LESS_THAN" = "less",
 *     "LESS_THAN_EQUAL_TO" = "less_equal",
 *     "GREATER_THAN" = "greater",
 *     "GREATER_THAN_EQUAL_TO" = "greater_equal",
 *     "BETWEEN" = "between",
 *     "NOT_BETWEEN" = "!between",
 *   }
 * )
 */
class WebformStateConditionTrigger extends EnumPluginBase {

}
