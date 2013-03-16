<?php
$title = 'Log in';

// Process form submissions.
if (isset($_REQUEST['action'])) {
  switch ($_REQUEST['action']) {
    
    case 'logout':
      session_destroy();
      session_start();
      notice('You have been logged out');
      break;
    
    case 'login':
      $result = mysql_query("SELECT * FROM users WHERE username = '" . mysql_real_escape_string($_POST['username']) . "' AND password = '" . mysql_real_escape_string($_POST['password']) . "'");
      if ($row = mysql_fetch_array($result)) {
        unset($row['password']);
        $_SESSION['user'] = $row;
        notice('You have been logged in.');
      } else {
        notice('Ah, sorry, either the username or password was incorrect.');
      }
      break;
    
  }
}

if (isset($_SESSION['user'])) {
  $content = '
    <h1>Welcome, ' . $_SESSION['user']['username'] . '</h1>
    <p>You are logged in, enjoy!</p>
    <ul>
      <li><a href="' .  url('admin/users.php') . '">Administer users</a></li>
      <li><a href="' .  url('admin/products.php') . '">Administer products</a></li>
    </ul>';
} else {
  $content = '
  <h1>'. $title . '</h1>
  <form action="login.php" method="post">
    <p>Username: <input type="text" name="username" /></p>
    <p>Password: <input type="password" name="password" /></p>
    <p><input type="submit" value="Log in" />
    <input type="hidden" name="action" value="login" />
  </form>';
}
