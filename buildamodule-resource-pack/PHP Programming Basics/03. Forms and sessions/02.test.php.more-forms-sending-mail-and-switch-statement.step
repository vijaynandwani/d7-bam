<?php

// Let's process the results from our forms.
$my_string = '';

if (isset($_REQUEST['action'])) {
  
  switch ($_REQUEST['action']) {
    
    case 'display':
      print '<h1>Your string was: ' . $_POST['my_string'] . '</h1>';
      break;
    
    case 'contact':
      // Let's take a look at the contents.
      var_dump($_POST);
      
      // Compose and send an email
      $body = '';
      foreach ($_POST as $key => $val) {
        $body .= $key . ': ' . $val . "\n";
      }
      $body = "Somone submitted a form on your site, here are the results:\n" . $body;
      
      // Your email address - change if you want to get this email.
      $email = 'chris@example.com';
      $subject = 'Contact from site';
      mail($email, $subject, $body);
      break;
    
    case 'persist':
      $my_string = $_GET['my_string'];
      print '<p><strong>You submitted a form and your value was saved!</strong></p>';
      break;
  }
  
}

?>

<?php // 1. In this example we use POST. ?>
<form action="test.php" method="post">
  My string: <input type="text" name="my_string" />
  <input type="submit" value="Display the string" />
  <input type="hidden" name="action" value="display" />
</form>
<hr />


<?php // 2. A more extensive example. ?>
<form action="test.php" method="post">
  <table>
    <tr>
      <td>Name: </td>
      <td><input type="text" name="name" /></td>
    </tr>
    <tr>
      <td>Email: </td>
      <td><input type="text" name="mail" /></td>
    </tr>
    <tr>
      <td>Comment: </td>
      <td><textarea name="comment"></textarea></td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="checkbox" name="attributes[]" value="interesting" /> I am interesting<br />
        <input type="checkbox" name="attributes[]" value="matching_socks" /> I wear matching socks
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" value="Submit" /></td>
    </tr>
  </table>
  <input type="hidden" name="action" value="contact" />
</form>
<hr />


<?php // 3. In this example, we make sure to populate the form input with the submitted value. ?>
<form action="test.php" method="get">
  This string will not disappear: <input type="text" name="my_string" value="<?php print $my_string; ?>" />
  <input type="submit" value="Save my string!" />
  <input type="hidden" name="action" value="persist" />
</form>
