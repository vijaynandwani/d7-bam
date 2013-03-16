<?php

// Moved functions to their own file so we can use them in page files.
include('includes/functions.php');

// If this is index.php, we won't get a path, so we need to set it.
$path = isset($_GET['path']) ? $_GET['path'] : 'home.php';


// Render featured products.
$featured_product_output = render_products(get_setting('featured_product_ids'));

// Get some variables to use in the template.
$company_name = get_setting('company_name');
$year = date('Y');

// Include the file that matches the path name.
include('pages/' . $path);

include('includes/page-template.php');