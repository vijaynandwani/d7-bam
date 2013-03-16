<?php
// $Id$

/**
 * @file
 * Admin page callback for the scaffolding module.
 */

/**
 * Builds and returns the scaffolding settings form.
 */
function scaffolding_admin_settings() {
  $form['scaffolding_example_setting'] = array(
    '#type' => 'textarea',
    '#title' => t('Example setting'),
    '#default_value' => variable_get('scaffolding_example_setting', ''),
    '#description' => t('This is an example setting.'),
    '#required' => TRUE,
  );
  return system_settings_form($form);
}