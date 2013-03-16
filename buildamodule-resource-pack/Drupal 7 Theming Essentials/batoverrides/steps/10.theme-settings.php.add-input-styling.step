<?php

/**
 * @file
 * Theme setting callbacks for the BAT Overrides theme
 */

/**
 * Implements hook_form_FORM_ID_alter().
 */
function batoverrides_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['input_background_color'] = array(
    '#type' => 'textfield',
    '#title' => t('Text input background color'),
    '#default_value' => theme_get_setting('input_background_color'),
    '#description' => t('Select a color to use text inputs.'),
    // Place this above other options.
    '#weight' => -2,
  );
}
