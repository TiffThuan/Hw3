<?php
require_once('util-db.php');
require_once('model-orders-by-customer.php');

$pageTitle = "Orders by Customer"; // Update title
include 'view-header.php';

// Validate and retrieve customer_id from GET parameters
if (isset($_GET['customer_id']) && is_numeric($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']); // Ensure it's an integer

    // Retrieve orders by customer_id
    $orders = selectOrdersByCustomer($customer_id);
    
    // Check if any orders were returned
    if (!$orders || $orders->num_rows === 0) {
        echo "<p>No orders found for this customer.</p>";
    }
} else {
    echo "<p>Invalid Customer ID. Please provide a valid Customer ID.</p>";
}

include 'view-orders-by-customer.php'; 
include 'view-footer.php';
?>
