
<?php
require_once('util-db.php');
$pageTitle = "Coffee Shop Management System";
include 'view-header.php';
?>

<div class="container">
    <h1>Welcome to the Coffee Shop Management System</h1>
    <p>Use the navigation links above to manage customer orders, view product details, and track order details.</p>
    
    <ul>
        <li><a href="orders-by-customer.php">View Orders by Customer</a></li>
        <li><a href="products.php">View Available Products</a></li>
        <li><a href="customers-with-orders.php">View Customers with Orders</a></li>
    </ul>
</div>

<?php include 'view-footer.php'; ?>
