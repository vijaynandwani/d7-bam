<?php

class Crud {
  
  var $options = array();
  
  /**
   *  Options:
   *  - 'table' - The name of the table
   *  - 'item_name' - The name of the item.
   *  - 'display_columns' - A set of key / value pairs with 'column_name' => 'Column Title'
   *  - 'id_column' - The column that acts as the unique ID for the table
   *  - 'default_sort_column' - The column to sort by by default.
   *  - 'add_edit_columns' - A set of key / value pairs. The key is the column name, and the value is an
   *     array that can contain 'title', 'prefix' and 'validate' (an array)
   */
  function Crud($options) {
    $this->options = $options;
    foreach ($options as $key => $val) {
      $this->$key = $val;
    }
    $this->path = $_GET['path'];
  }
  
  function view() {
    $table_rows = '';
    $result = mysql_query("SELECT * FROM " . $this->table . " ORDER BY " . $this->default_sort_column . " ASC");
    while ($row = mysql_fetch_array($result)) {
      if (!isset($table_header)) {
        $table_header = '';
        foreach ($this->display_columns as $col_title) {
          $table_header .= '<th>' . $col_title . '</th>';
        }
        $table_header = '<tr>' . $table_header . '<th>Edit</th><th>Delete</th></tr>';
      }
      $table_row = '';
      foreach($this->display_columns as $col_name => $col_title) {
        $table_row .= '<td>' . $row[$col_name] . '</td>';
      }
      $table_row .= '
        <td><a href="' . url($this->path) . '?action=edit_form&id=' . $row[$this->id_column] . '">Edit</a></td>
        <td><a href="' . url($this->path) . '?action=delete&id=' . $row[$this->id_column] . '">Delete</a></td>';
      $table_rows .= '<tr>' . $table_row . '</tr>';
    }
    
    $output = '
      <p><a href="' . url($this->path) . '?action=add_form">Add ' . $this->item_name . '</a></p>
      <table>' . $table_header . $table_rows . '</table>';
    
    return $output;
  }
  
  function form($id) {
    $form_id = 'admin_add_edit_' . $this->table;
    if (isset($_POST['form_id']) && $_POST['form_id'] == $form_id) {
      $values = $_POST;
    // If the edit form is being loaded for the first time.
    } elseif ($id != '') {
      $result = mysql_query("SELECT * FROM " . $this->table . " WHERE " . $this->id_column . " = '" . mysql_real_escape_string($id) . "'");
      $values = mysql_fetch_array($result);
    // If this is an add form, set the values to empty.
    } else {
      // Add unique ID to empty values.
      $values[$this->id_column] = '';
      foreach ($this->add_edit_columns as $column_name => $column_options) {
        $values[$column_name] = '';
      }
    }
    
    $submit_text = 'Add item';
    $action = 'add_item';
    $title = 'Add ' . $this->item_name;
    
    if ($id != '') {
      $title = 'Edit ' . $this->item_name;
      $submit_text = 'Save changes';
      $action = 'edit_item';
    }
    
    $form_inputs = '';
    foreach ($this->add_edit_columns as $column_name => $column_options) {
      // Set the default to a text field.
      if (!isset($column_options['type'])) {
        $column_options['type'] = 'text';
      }
      
      $input_id = 'input_'. $this->table . '_' . $column_name;
      
      // Render the input.
      switch ($column_options['type']) {
        case 'text':
          $input_rendered = '<input type="text" id="' . $input_id . '" name="' . $column_name . '" value="' . $values[$column_name] . '" />';
          break;
        
        case 'textarea':
          $input_rendered = '<textarea id="' . $input_id . '" name="' . $column_name . '">' . htmlentities($values[$column_name]) . '</textarea>';
          break;
      }
      
      $form_inputs  .= '<p>' . $column_options['title'] . ': ' . (isset($column_options['prefix']) ? $column_options['prefix'] : '') . $input_rendered . '</p>';
    }
    
    return '
      <h1>' . $title . '</h1>
      <form action="' . url($this->path) . '" method="post">
        ' . $form_inputs . '
        <p><input type="submit" value="' . $submit_text . '" /></p>
        <input type="hidden" name="form_id" value="' . $form_id . '" />
        <input type="hidden" name="action" value="' . $action . '" />
        <input type="hidden" name="id" value="' . $id . '" />
      </form>';

  }
  
  function validate($values) {
    
    $errors = array();
    
    foreach ($this->add_edit_columns as $column_name => $column_options) {
      foreach ($column_options['validate'] as $type) {
        
        switch ($type) {
        
          // Required value.
          case 'required':
            if (trim($values[$column_name]) == '') {
              $errors[] = 'Please enter a value for ' . $column_name . '.';
            }
            break;
          
          // Is a number
          case 'numeric':
            if (trim($values[$column_name]) != '') {
              if (!is_numeric($values[$column_name])) {
                $errors[] = 'Please enter only numbers for '. $column_name . '.';
              }
            }
            break;
          
          // Contains just letters and numbers
          case 'alphanumeric':
            if (trim($values[$column_name]) != '') {
              if (!ctype_alnum($values[$column_name])) {
                $errors[] = 'Please enter only letters or numbers for '. $column_name . '.';
              }
            }
            break;
          
        }
      }
    }
    
    return $errors;
  }
  
  function process($values) {
    
    // Since we're using 'id' for the unique id input, set the actual unique id column value.
    $values[$this->id_column] = $values['id'];
    
    $errors = $this->validate($values);
    
    // If there's any errors, add a notice
    if (count($errors) > 0) {
      notice(array_to_list($errors));
      return $this->form($values['id']);
      
    // If no errors, go ahead and add the entry.
    } else {
    
      $clean_columns[] = $this->id_column;
      foreach ($this->add_edit_columns as $column_name => $column_options) {
        $clean_columns[] = $column_name;
      }
      foreach ($clean_columns as $column) {
        $clean_values[$column] = trim(mysql_real_escape_string($values[$column]));
      }
      
      // Remove the unique ID column from values and columns so we can use implode() later.
      $update_values = $clean_values;
      unset($update_values[$this->id_column]);
      $update_columns = $clean_columns;
      // We can do this because we know we added the id column first.
      unset($update_columns[0]);
      
      //die(var_dump($values));
      // Do an insert if we're adding.
      if ($clean_values[$this->id_column] == '') {
        $add_query = "'" . implode("','", $update_values) . "'";
        $column_names = implode(',', $update_columns);
        $sql = "INSERT INTO " . $this->table . " (" . $column_names . ") VALUES (" . $add_query . ")";
      
      // Do an update if we're editing.
      } else {
        foreach ($update_columns as $column) {
          $update_query_array[] = " " . $column  . " = '" . $clean_values[$column] . "' ";
        }
        $update_query = implode(',', $update_query_array);
        $sql = "
          UPDATE " . $this->table . "
          SET " . $update_query . "
          WHERE " . $this->id_column . " = '" . $clean_values[$this->id_column] . "'";
      }
      $result = mysql_query($sql);
      notice($sql);
      
      // $result will return TRUE if it worked. Otherwise, we should show an error to troubleshoot.
      if ($result) {
        notice(($clean_values[$this->id_column] == '') ? 'The ' . $this->item_name . ' was added.' : 'The ' . $this->item_name . ' was updated');
      } else {
        // If something happened, let's show an error.
        notice(mysql_error());
      }
    }
  }
  
  function delete($id) {
    mysql_query("DELETE FROM " . $this->table . " WHERE " . $this->id_column . " = '" . mysql_real_escape_string($id) . "'");
    notice('The ' . $this->item_name . ' with ID ' . $id . ' was deleted.');
  }
  
  function display_page() {
    
    $content = '';
    
    if (isset($_REQUEST['action'])) {
      
      switch ($_REQUEST['action']) {
        
        case 'delete':
          $this->delete($_GET['id']);
          break;
        
        case 'edit_form':
        case 'add_form':
          $content .= $this->form((isset($_GET['id']) ? $_GET['id'] : ''));
          break;
        
        case 'add_item':
        case 'edit_item':
          $content .= $this->process($_POST);
          break;
      }
    }
  
    // If we didn't specify what we wanted to display, show the list of data.
    if ($content == '') {
      $content = $this->view();
    }
    
    return $content;
  }
}