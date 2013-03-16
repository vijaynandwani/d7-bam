<?php

include('includes/crud.php');

$title = 'Administer users';

$options = array(
  'table' => 'users',
  'item_name' => 'user',
  'display_columns' => array(
    'uid' => 'UID',
    'username' => 'Username',
  ),
  'id_column' => 'uid',
  'default_sort_column' => 'username',
  'add_edit_columns' => array(
    'username' => array(
      'title' => 'Username',
      'validate' => array('required', 'alphanumeric'),
    ),
    'password' => array(
      'title' => 'Password',
      'validate' => array('required', 'alphanumeric'),
    ),
  ),
);

$crud = new Crud($options);
$content = $crud->display_page();