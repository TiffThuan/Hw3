<?php
require_once('util-db.php');
$pageTitle = "Coffee Shop Management System";
include 'view-header.php';
?>

<div class="container">
    <h1>Welcome to the Coffee Shop Management System</h1>
    <p>Use the navigation links above to manage customer orders, view product details, and track order details.</p>
    
    <ul>
        <li><a href="orders.php">View Orders by Customer</a></li>
        <li><a href="customers.php">View Customer Details</a></li>
        <li><a href="products.php">View Available Products</a></li>
        <li><a href="reviews.php">View Product Reviews</a></li> <!-- New link to Reviews -->
    </ul>
</div>

<?php include 'view-footer.php'; ?>
