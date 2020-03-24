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
    if (isset($value['#vocabulary'])) {
      $vocabulary = $value['#vocabulary'];
    }
    else {
      $element_info = $value['plugin']->getInfo();
      $vocabulary = $element_info['#vocabulary'];
    }

    $terms = $taxonomy_storage->loadTree($vocabulary, 0, $args['depth'], TRUE);

    foreach ($terms as $term) {
      yield $term;
    }

  }

}
