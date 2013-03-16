<?php

  // Modify this first line with arguments you accept.
  $possible_arguments = array('count', 'time-first');
  
  // Loop through each passed arguments and see if it matches up with an argument we accept.
  foreach ($_SERVER['argv'] as $passed) {
    foreach ($possible_arguments as $arg) {
      if (strstr($passed, '--' . $arg . '=')) {
        $arguments[$arg] = str_replace('--' . $arg . '=', '', $passed);
      }
    }
  }
  
  // Set default count.
  if (!isset($arguments['count'])) {
    $arguments['count'] = 10;
  }
  
  // Run query.
  $query = db_select('users', 'u')
    ->extend('PagerDefault')
    ->orderBy('access', 'DESC')
    ->fields('u')
    ->condition('uid', 0, '<>')
    ->limit($arguments['count']);

  $result = $query->execute();

  // Loop through results.
  foreach ($result as $row) {
    if ($arguments['time-first'] == 1) {
      echo format_interval(time() - $row->access) . " ago - " .  $row->name . "\n";
    } else {
      echo $row->name . ' - ' . format_interval(time() - $row->access) . " ago\n";
    }
  }