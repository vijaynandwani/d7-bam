<?php

include('includes/crud.php');

$title = 'Administer pages';

$options = array(
  'table' => 'pages',
  'item_name' => 'page',
  'display_columns' => array(
    'page_id' => 'Page ID',
    'title' => 'Title',
  ),
  'id_column' => 'page_id',
  'default_sort_column' => 'page_id',
  'add_edit_columns' => array(
    'title' => array(
      'title' => 'Title',
      'validate' => array('required'),
    ),
    'path' => array(
      'title' => 'Path',
      'validate' => array('required'),
    ),
    'content' => array(
      'title' => 'Content',
      'validate' => array('required'),
      'type' => 'textarea',
    ),
  ),
);

$crud = new Crud($options);
$content = $crud->display_page();