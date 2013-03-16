<?php
  
// Takes array of product IDs and returns a rendered product list.
function render_products($product_ids = '') {
  
  // So we only need to include the product array once.
  static $products;
  
  // Pull in the data.
  if (!isset($products)) {
    include('data/product-data.php');
  }
  
  // Allow an empty value to display all the products.
  if ($product_ids == '') {
    $product_ids = array();
    foreach ($products as $pid => $options) {
      $product_ids[] = $pid;
    }
  }
  
  // This way we can pass one number or an array to the function.
  if (!is_array($product_ids)) {
    $product_ids = array($product_ids);
  }
  
  // Render each product.
  $output = '';
  
  foreach ($product_ids as $pid) {
    $output .= '
      <div class="product">
        <div class="product-img"><img src="images/' . $products[$pid]['img'] . '" /></div>
        <div class="product-price">$' . $products[$pid]['price'] . '</div>
        <div class="product-title">' . $products[$pid]['title'] . '</div>
        <a class="cart-button" href="#">Add to cart</a>
      </div>';
  }
  
  return $output;
}

// Returns a setting from settings.php.
function get_setting($name) {
  static $settings;
  
  if (!isset($settings)) {
    include('settings/settings.php');
  }
  
  return $settings[$name];
}