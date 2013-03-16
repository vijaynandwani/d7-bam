<?php

include('includes/crud.php');

$title = 'Administer products';

$options = array(
  'table' => 'products',
  'item_name' => 'product',
  'display_columns' => array(
    'pid' => 'PID',
    'title' => 'Title',
    'price' => 'Price',
  ),
  'id_column' => 'pid',
  'default_sort_column' => 'title',
  'add_edit_columns' => array(
    'title' => array(
      'title' => 'Title',
      'validate' => array('required'),
    ),
    'price' => array(
      'title' => 'Price',
      'prefix' => '$',
      'validate' => array('required', 'numeric'),
    ),
    'image' => array(
      'title' => 'Image',
      'validate' => array('required'),
    ),
  ),
);

$content = data_administration_page($options);