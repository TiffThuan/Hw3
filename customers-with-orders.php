<?php
require_once('util-db.php');
require_once('model-customers-with-orders.php');

$pageTitle = "Customers with Orders"; 
include 'view-header.php';

$customersWithOrders = selectCustomersWithOrders();
if ($customersWithOrders && $customersWithOrders->num_rows > 0) {
    include 'view-customers-with-orders.php'; 
} else {
    echo "<p>No customers with orders found.</p>";
}

include 'view-footer.php';
?>
