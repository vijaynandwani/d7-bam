<?php

$data['description'] = "You're in a house. There's a door to the east and a window to the south.";

$data['commands'] = array(
  'east' => 'move_to("yard");',
  'south' => 'move_to("garden");',
  'look' => 'journal(in_array("Fishing pole", $_SESSION["inventory"]) ? standard_text("nothing") : "Hey, there\'s a fishing pole on the ground!");',
  'pick up fishing pole' => 'pick_up("Fishing pole");',
  'jump' => "log_standard_text('pain');",
);