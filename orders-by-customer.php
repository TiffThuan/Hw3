<?php
require_once('util-db.php');
require_once('model-orders.php'); // Ensure the correct model is included

$pageTitle = "Orders by Customer";
include 'view-header.php';

// Enable error reporting for debugging
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Fetch customer_id from the URL (should be passed as ?customer_id=...)
$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : null;

if ($customer_id && $customer_id > 0) {
    // Fetch orders by this customer_id
    $orders = selectOrdersByCustomer($customer_id);

    if ($orders && $orders->num_rows > 0) {
        include 'view-orders-by-customer.php'; // This will display the orders
    } else {
        echo "<p>No orders found for this customer.</p>";
    }
} else {
    echo "<p>Invalid Customer ID. Please provide a valid Customer ID.</p>";
}

include 'view-footer.php';
?>
