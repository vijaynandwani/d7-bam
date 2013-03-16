<!DOCTYPE html>
<html>
  
  <head>
    <title><?php print $title; ?> | <?php print $company_name; ?></title>
    <link type="text/css" rel="stylesheet" media="all" href="<?php print url('styles/style.css'); ?>" />
    <?php print $additional_css_files; ?>
  </head>

  <body>
    <div class="body">
      <div class="header">
        <div class="user-menu"><?php print $login_logout; ?></div>
        <div class="logo"><img src="<?php print url('images/logo.png'); ?>" alt="Logo" /></div>
        <div class="site-title">AmaZING! Inc: Throwing Sticks Done Right</div>
        <div class="header-menu">
          <ul>
            <li><a href="<?php print url('index.php'); ?>">Home</a></li>
            <li><a href="<?php print url('products.php'); ?>">Products</a></li>
            <li><a href="<?php print url('about.php'); ?>">About</a></li>
            <li><a href="<?php print url('contact.php'); ?>">Contact</a></li>
          </ul>
        </div>
      </div>
  
      <div class="content-outer">
        <div class="left-column">
          <div class="left-column-title">Featured sticks!</div>
          <?php print $featured_product_output; ?>
        </div>
        <div class="content">
          <?php print $notices; ?>
          <?php print $content; ?>
        </div>
        <div class="clear"></div>
      </div>
  
      <div class="footer">
        &copy; <?php print $year; ?> <?php print $company_name; ?>
      </div>
    </div>
  </body>

</html>