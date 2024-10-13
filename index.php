<?php
require_once('util-db.php');
$pageTitle = "Coffee Shop Management System";
include 'view-header.php';
?>

<div class="container">
    <h1>Welcome to the Coffee Shop Management System</h1>
   <p>Manage your customer orders, products, and reviews efficiently with the tools below.</p>
    
    <ul>
        <li><a href="orders.php">View Orders by Customer</a></li>
        <li><a href="customers.php">View All Customers</a></li>
        <li><a href="products.php">View Available Products</a></li>
        <li><a href="reviews.php">View Product Reviews</a></li> <!-- New link to Reviews -->
    </ul>
</div>

<?php include 'view-footer.php'; ?>
