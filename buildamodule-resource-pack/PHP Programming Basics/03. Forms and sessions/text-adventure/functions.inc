<?php

// Starts the session and initializes some session variables.
function start_adventure_session() {
  session_start();
  if (!isset($_SESSION['location'])) {
    $_SESSION['location'] = 'house';
    $_SESSION['inventory'] = array();
  }
}

// Process the command that the user inputs.
function run_command($command) {
  
  $global_commands = array('reset', 'wait', 'pick nose');
  
  if (in_array($command, $global_commands)) {
    switch ($command) {
      
      case 'reset':
        session_destroy();
        start_adventure_session();
        journal('You have reset your adventure. Back to square one.');
        return;
      
      case 'wait':
        journal('You wait. What fun.');
        return;
      
      case 'pick nose':
        log_standard_text('bad');
        return;
    }
  }
  
  $command = strtolower($command);
  $commands = current_location_data('commands');
  if (key_exists($command, $commands)) {
    eval($commands[$command]);
  } else {
    log_standard_text('nope');
    journal(current_location_data('description'));
  }
}

// A multi-use function to either add an entry to the log or render the log as HTML.
function journal($text = '', $action = 'add') {
  static $log_array;
  
  if ($action == 'add') {
    $log_array[] = $text;
  } elseif ($action == 'get') {
    // Add the location description if we're rendering the log and it's empty.
    if (count($log_array) == 0) {
      journal(current_location_data('description'));
    }
    return '<ul><li>' . implode('</li><li>', $log_array) .'</li></ul>';
  }
}

// A shortcut function.
function get_journal() {
  return journal('', 'get');
}

// Renders the inventory as HTML.
function get_inventory() {
  $inventory = '<p>You have nothing in your inventory.</p>';
  if (count($_SESSION['inventory']) > 0) {
    $inventory = '<ul><li>' . implode('</li><li>', $_SESSION['inventory']) . '</li></ul>';
  }
  return '<h4>Inventory:</h4>' . $inventory;
}

// Gets the information about a location from an include file.
function get_location_data($location) {
  // This way we don't have to get data more than once. Reduces execution time.
  static $locations;
  
  // Include the code if we don't have the data already.
  if (!isset($locations[$location])) {
    include('locations/' . $location . '.inc');
    $locations[$location] = $data;
  }

  return $locations[$location];
}

// Gets the current location data, or a speicific piece of the data.
function current_location_data($key = '') {
  $location_data = get_location_data($_SESSION['location']);
  if ($key == '') {
    return $location_data;
  }
  return $location_data[$key];
}

// Add some text to the log to display.
function log_standard_text($name) {
  journal(standard_text($name));
}

// Move where the character is located.
function move_to($place) {
  $_SESSION['location'] = $place;
  journal(current_location_data('description'));
}

// Pick up an object.
function pick_up($object) {
  
  if (in_array($object, $_SESSION['inventory'])) {
    journal('Sorry, it looks like you aready have the ' . $object);
  } else {
    $_SESSION['inventory'][] = $object;
    journal('You pick up the ' . $object . '. How exciting!');
  }
}

// Return some standard text, centralize for easy re-use and modification.
function standard_text($key) {
  $standard_text = array(
    'nothing' => "There's nothing of importance here. Move along.",
    'bad' => "Don't do that! What would your mother think?",
    'pain' => "Ouch! That hurt!",
    'nope' => "Sorry, you can't do that.",
  );
  
  return $standard_text[$key];
}

?>