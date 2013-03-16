<?php

$title = 'Administer products';


// Display people in the database as a table with a delete link.
function admin_products_list() {
  
  $output = '';
  $result = mysql_query("SELECT * FROM products ORDER BY title ASC");
  while ($row = mysql_fetch_array($result)) {
    $output .= '
      <tr>
        <td>' . $row['pid'] . '</td>
        <td>' . $row['title'] . '</td>
        <td>$' . $row['price'] . '</td>
        <td><a href="' . url('admin/products.php') . '?action=delete&pid=' . $row['pid'] . '">Delete</a></td>
        <td><a href="' . url('admin/products.php') . '?action=edit_form&pid=' . $row['pid'] . '">Edit</a></td>
      </tr>';
  }
  if ($output != '') {
    $output = '
      <table>
        <tr>
          <th>PID</th>
          <th>Title</th>
          <th>Price</th>
          <th>Delete</th>
          <th>Edit</th>
        </tr>
        ' . $output . '
      </table>';
  } else {
    $output = '<p>There are no products.</p>';
  }
  
  return '<p><a href="' . url('admin/products.php') . '?action=add_form">Add product</a></p>' . $output;
}

// Creates a form to add entries into our 'people' table.
function admin_products_add_edit_form($pid = '') {
  
  // If the form has been submitted.
  if (isset($_POST['form_id']) && $_POST['form_id'] == 'admin_products_add_edit') {
    $values = $_POST;
  // If the edit form is being loaded for the first time.
  } elseif ($pid != '') {
    $result = mysql_query("SELECT * FROM products WHERE pid = '" . mysql_real_escape_string($pid) . "'");
    $values = mysql_fetch_array($result);
  // If this is an add form, set the values to empty.
  } else {
    $values = array('pid' => '', 'title' => '', 'price' => '', 'image' => '');
  }
  
  $edit_text = '';
  $submit_text = 'Add entry';
  $action = 'add_product';
  $title = 'Add product';
  
  if ($values['pid'] != '') {
    $title = 'Edit product ' . $values['title'];
    $submit_text = 'Save changes';
    $action = 'edit_product';
  }
  
  return '
    <h1>' . $title . '</h1>
    <form action="' . url('admin/products.php') . '" method="post">
      <p>Title: <input type="text" name="title" value="' . $values['title'] . '" /></p>
      <p>Price: $<input type="text" name="price" value="' . $values['price'] . '" /></p>
      <p>Image: <input type="text" name="image" value="' . $values['image'] . '" /></p>
      <p><input type="submit" value="' . $submit_text . '" /></p>
      <input type="hidden" name="form_id" value="admin_products_add_edit" />
      <input type="hidden" name="action" value="' . $action . '" />
      <input type="hidden" name="pid" value="' . $values['pid'] . '" />
    </form>';
}

// Run through validation functions
function admin_products_add_edit_form_validate($values) {

  $errors = array();
  
  // Required validation.
  $required = array('title', 'price', 'image');
  foreach($required as $input_name) {
    if (trim($values[$input_name]) == '') {
      $errors[] = 'Please enter a value for ' . $input_name . '.';
    }
  }
  
  // Numeric validation.
  $alphanumeric = array('price');
  foreach ($alphanumeric as $input_name) {
    if (trim($values[$input_name]) != '') {
      if (!is_numeric($values[$input_name])) {
        $errors[] = 'Please enter only numbers for '. $input_name . '.';
      }
    }
  }
  
  return $errors;
}


// Process the add and edit forms.
function admin_products_add_edit_form_process($values) {
  
  $errors = admin_products_add_edit_form_validate($values);
  
  // If there's any errors, add a notice
  if (count($errors) > 0) {
    notice(array_to_list($errors));
    return admin_products_add_edit_form($values['pid']);
    
  // If no errors, go ahead and add the person.
  } else {
  
    // Changed name of variable here.
    $input_names = array('pid', 'title', 'price', 'image');
    foreach ($input_names as $input_name) {
      $clean_values[$input_name] = trim(mysql_real_escape_string($values[$input_name]));
    }
    
    // Do an insert if we're adding.
    if ($clean_values['pid'] == '') {
      $add_values = $clean_values;
      unset($add_values['pid']);
      $add_query = "'" . implode("','", $add_values) . "'";
      $sql = "INSERT INTO products (title, price, image) VALUES (" . $add_query . ")";
    
    // Do an update if we're editing.
    } else {
      $sql = "
        UPDATE products
        SET title = '" . $clean_values['title'] . "',
          price = '" . $clean_values['price'] . "',
          image = '" . $clean_values['image'] . "'
        WHERE pid = '" . $clean_values['pid'] . "'";
    }
    $result = mysql_query($sql);
    notice($sql);
    
    // $result will return TRUE if it worked. Otherwise, we should show an error to troubleshoot.
    if ($result) {
      notice(($clean_values['pid'] == '') ? 'The product was added.' : 'The product was updated');
    } else {
      // If something happened, let's show an error.
      notice(mysql_error());
    }
  }
}

// Delete a product.
function admin_products_delete_product($pid) {
  mysql_query("DELETE FROM products WHERE pid = '" . mysql_real_escape_string($pid) . "'");
  notice('The product with PID ' . $pid . ' was deleted.');
}

$content = '';


if (isset($_REQUEST['action'])) {
  
  switch ($_REQUEST['action']) {
    
    case 'delete':
      admin_products_delete_product($_GET['pid']);
      break;
    
    case 'edit_form':
    case 'add_form':
      $content .= admin_products_add_edit_form((isset($_GET['pid']) ? $_GET['pid'] : ''));
      break;
    
    case 'edit_product':
    case 'add_product':
      $content .= admin_products_add_edit_form_process($_POST);
      break;
  }
}

// If we didn't specify what we wanted to display, show the list of products.
if ($content == '') {
  $content = admin_products_list();
}