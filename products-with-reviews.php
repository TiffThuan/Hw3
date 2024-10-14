<?php
require_once('model-products-with-reviews.php');

$pageTitle = "Products with Reviews";
include 'view-header.php';

// Fetch products with reviews
$productsWithReviews = ProductsWithReviews(); 
include 'view-products-with-reviews.php'; // Include the view

include 'view-footer.php';
?>
