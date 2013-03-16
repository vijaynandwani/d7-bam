<?php

include('functions.inc');

// Initialize session.
start_adventure_session();

// Run a command if the user entered something.
if (isset($_POST['command'])) {
  run_command($_POST['command']);
}

?>

<h1 style="text-align:center">A simple adventure</h1>
<div style="background:silver;padding:10px;border:5px solid #333;margin-left:100px;margin-right:100px;">
  <div style="padding-bottom:10px;">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" style="margin:0px">
      Your command: <input type="text" name="command" /> <input type="submit" value="Do it" />
    </form>
  </div>
  <div style="background:black;color:green;padding:10px;border:1px solid white;"><?php print get_journal() . get_inventory(); ?></div>
</div>