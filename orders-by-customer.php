<?php
require_once('util-db.php');
require_once('model-orders-by-customer.php');

$pageTitle = "Orders by Customer"; 
include 'view-header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $customerId = intval($_GET['id']);
    $orders = selectOrdersByCustomer($customerId);
    if ($orders && $orders->num_rows > 0) {
        include 'view-orders-by-customer.php'; 
    } else {
        echo "<p>No orders found for this customer.</p>";
    }
} else {
    echo "<p>Invalid customer ID provided.</p>";
}

include 'view-footer.php';
?>
