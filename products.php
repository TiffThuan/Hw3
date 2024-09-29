<?php
require_once('util-db.php');
require_once('model-products.php'); // Make sure this model exists

$pageTitle = "Available Products"; // Update title
include 'view-header.php';

// Fetch all products
$products = selectProducts(); // Ensure this function is defined in your model

include 'view-products.php'; // Create this view to display products
include 'view-footer.php';
?>
