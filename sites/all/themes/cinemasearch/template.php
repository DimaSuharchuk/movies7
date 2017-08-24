<?php

/**
 * Implements template_preprocess_html().
 */
function cinemasearch_preprocess_html(&$variables) {
}

/**
 * Implements template_preprocess_page.
 */
function cinemasearch_preprocess_page(&$variables) {
}

/**
 * Implements template_preprocess_node.
 */
function cinemasearch_preprocess_node(&$variables) {
  if (
    isset($variables['type']) && $variables['type'] == 'film'
    && isset($variables['view_mode']) && $variables['view_mode'] == 'teaser'
  ) {
    // Hide regular teaser title link.
    $variables['page'] = TRUE;

    // Remove default node teaser's "Read more" link.
    unset($variables['content']['links']['node']['#links']['node-readmore']);

    // Set custom link to content as title + year.
    $year = $variables['field_year'][LANGUAGE_NONE][0]['value'];
    $variables['content']['title'] = [
      '#markup' => html_entity_decode($variables['title'], ENT_QUOTES) . ' (' . $year . ')',
      '#prefix' => '<div class="film-title-link">',
      '#suffix' => '</div>',
    ];
  }
}

/**
 * Implements template_preprocess_field.
 */
function cinemasearch_preprocess_field(&$variables) {
  if (isset($variables['element'])) {
    $element = &$variables['element'];
    if (isset($element['#bundle']) && $element['#bundle'] == 'film') {
      // Add classes to every field.
      switch ($element['#view_mode']) {
        case 'full':
          $variables['classes_array'][] = 'large-8';
          $variables['classes_array'][] = 'column';
          break;
      }
    }
  }
}

/**
 * Implements theme_field__field_type().
 */
function cinemasearch_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<span class="field-label">' . $variables['label'] . ': </span>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

  return $output;
}
