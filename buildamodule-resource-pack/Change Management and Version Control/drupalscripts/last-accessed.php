<?php
  $query = db_select('users', 'u')
    ->extend('PagerDefault')
    ->orderBy('access', 'DESC')
    ->fields('u')
    ->condition('uid', 0, '<>')
    ->limit(10);

  $result = $query->execute();

  foreach ($result as $row) {
    echo $row->name . ' - ' . format_interval(time() - $row->access) . " ago\n";
  }