<?php

// Add a class to the html.tpl.php.
// Now we can override classes using .body-authenticated .someclass { }.
function batoverrides_preprocess_html(&$variables) {
  if (in_array('authenticated user', $variables['user']->roles)) {
    $variables['classes_array'][] = 'body-authenticated';
  }
}

// Add a class to node.tpl.php.
function batoverrides_preprocess_node(&$variables) {
  $variables['classes_array'][] = 'nodeclass';
}

// Add a class to page.tpl.php.
function batoverrides_preprocess_page(&$variables) {
  $variables['classes_array'][] = 'pageclass';
  
  // Grab new background color setting and use it.
  $color = theme_get_setting('input_background_color');
  drupal_add_css('input { background-color:' . $color . ';}', 'inline');
}