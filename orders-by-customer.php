<?php
require_once ('util-db.php');
require_once('model-orders-by-customer.php');

$pageTitle = "Orders by Customer"; 
include 'view-header.php';

$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : null; // Ensure you retrieve the correct ID
if ($customer_id) {
    $orders = selectOrdersByCustomer($customer_id);
    if ($orders->num_rows === 0) {
        echo "<p>No orders found for this customer.</p>";
    } else {
        include 'view-orders-by-customer.php'; 
    }
} else {
    echo "Invalid Customer ID. Please provide a valid Customer ID.";
}

include 'view-footer.php';
?>
