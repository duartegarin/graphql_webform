<?php

namespace Drupal\graphql_webform\Plugin\GraphQL\Fields\Element;

use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\graphql\GraphQL\Execution\ResolveContext;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * A field to retrieve the term options of a select with depth filter.
 *
 * @GraphQLField(
 *   id = "webform_element_term_options",
 *   parents = {"WebformElementTermSelect"},
 *   type = "[TaxonomyTerm]",
 *   name = "termOptions",
 *   nullable = true,
 *   multi = false,
 *   arguments = {
 *     "depth" = "Integer",
 *   },
 * )
 */
class WebformElementTermOptions extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function resolveValues($value, array $args, ResolveContext $context, ResolveInfo $info) {

    /** @var \Drupal\taxonomy\TermStorageInterface $taxonomy_storage */
    $taxonomy_storage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');
    $depth_value = NULL;
    if (isset($value['#vocabulary'])) {
      $vocabulary = $value['#vocabulary'];
    }
    else {
      $element_info = $value['plugin']->getDefaultProperties();
      $vocabulary = $element_info['vocabulary'];
      $depth_value = isset($element_info['depth']) ? $element_info['depth'] : NULL;
    }

    if (isset($value['#depth'])) {
      $depth_value = $value['#depth'];
    }

    $depth = !empty($args['depth']) ? $args['depth'] : $depth_value;

    $terms = $taxonomy_storage->loadTree($vocabulary, 0, $depth, TRUE);

    foreach ($terms as $term) {
      yield $term;
    }

  }

}
