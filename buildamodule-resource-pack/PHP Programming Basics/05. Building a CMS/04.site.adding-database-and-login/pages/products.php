<?php
$title = 'World Class Throwing Sticks - Product Page';

$product_output = render_products();

$content = <<<EOD
  <h1>$title</h1>
  <p>Below is our complete catalog of high-end throwing sticks.</p>
  <div class="main-product-listing">$product_output</div>
EOD;
