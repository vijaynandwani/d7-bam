<?php

// Start the session.
session_start();

// Moved functions to their own file so we can use them in page files.
include('includes/functions.php');

// Connect to the database.
db_connect();

// If this is index.php, we won't get a path, so we need to set it.
$path = isset($_GET['path']) ? $_GET['path'] : 'home.php';


// Render featured products.
$featured_product_output = render_products(get_setting('featured_product_ids'));

// Produce some variables to use in the template.
$company_name = get_setting('company_name');
$year = date('Y');

// Show log in / log out links.
$login_logout = '<a href="login.php">Log in</a>';
if (isset($_SESSION['user'])) {
  $login_logout = '<a href="login.php">My account</a> | <a href="login.php?action=logout">Log out</a>';
}

// Include the file that matches the path name.
include('pages/' . $path);

$notices = get_notices();

include('includes/page-template.php');