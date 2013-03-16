<?php

/**
 * @file
 *   Begin the process of additing additonal user utilities.
 */

/**
 * Implementation of hook_drush_command().
 */
function usersplus_drush_command() {
  $items = array();

  // The 'make-me-a-sandwich' command
  $items['usersplus-last'] = array(
    'description' => "Show the last users to access the site.",
    'options' => array(
      'count' => 'The number of users to display',
    ),
    'examples' => array(
      'drush uplusl --count=50 --time-first=1' => 'Show 50 users and show the date before the username.',
    ),
    'aliases' => array('uplusl'),
    'bootstrap' => DRUSH_BOOTSTRAP_DRUPAL_FULL,
  );

  return $items;
}

/**
 * Implementation of hook_drush_help().
 */
function dursh_usersplus_drush_help($section) {
  switch ($section) {
    case 'drush:usersplus-last':
      return dt("This command will show a list of the most recent users to access your site.");
  }
}


/**
 * Usersplus last accessed command
 */
function drush_usersplus_last() {
  $count = drush_get_option('count');
  if (!$count) {
    $count = 10;
  }
  
  // Run query.
  $query = db_select('users', 'u')
    ->extend('PagerDefault')
    ->orderBy('access', 'DESC')
    ->fields('u')
    ->condition('uid', 0, '<>')
    ->limit($count);

  $result = $query->execute();

  // Loop through results.
  foreach ($result as $row) {
    if (drush_get_option('time-first') == 1) {
      drush_print(format_interval(time() - $row->access) . " ago - " .  $row->name);
    } else {
      drush_print($row->name . ' - ' . format_interval(time() - $row->access) . " ago");
    }
  }
}