<?php

$data['description'] =  "You are next to a pond. It looks like of green. Or is that brown? Purple?";

$data['commands'] = array(
  'west' => 'move_to("house");',
  'north' => 'move_to("yard");',
  'use fishing pole' => 'if (in_array("Fishing pole", $_SESSION["inventory"])) { journal("You use your fishing pole to get a fish. It looks a little scary, but maybe it will be useful for something later on."); pick_up("Fish"); } else { journal("You don\'t have a fishing pole.");}',
);