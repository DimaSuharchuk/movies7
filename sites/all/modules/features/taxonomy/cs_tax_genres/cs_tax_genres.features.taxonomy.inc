<?php
/**
 * @file
 * cs_tax_genres.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function cs_tax_genres_taxonomy_default_vocabularies() {
  return array(
    'genres' => array(
      'name' => 'Genres',
      'machine_name' => 'genres',
      'description' => 'All films genres',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
  );
}
