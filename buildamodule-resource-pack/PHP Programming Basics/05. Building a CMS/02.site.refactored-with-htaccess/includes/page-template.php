<!DOCTYPE html>
<html>
  
  <head>
    <title><?php print $title; ?> | AmaZING! Inc.</title>
    <link type="text/css" rel="stylesheet" media="all" href="styles/style.css" />
  </head>

  <body>
    <div class="body">
      <div class="header">
        <div class="logo"><img src="images/logo.png" alt="Logo" /></div>
        <div class="site-title">AmaZING! Inc: Throwing Sticks Done Right</div>
        <div class="header-menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </div>
  
      <div class="content-outer">
        <div class="left-column">
          <div class="left-column-title">Featured sticks!</div>
          <?php print $featured_product_output; ?>
        </div>
        <div class="content">
          <?php print $content; ?>      
        </div>
        <div class="clear"></div>
      </div>
  
      <div class="footer">
        &copy; 2011 AmaZING! Inc.
      </div>
    </div>
  </body>

</html>