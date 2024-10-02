<?php
require_once('util-db.php');
require_once('model-orders.php'); // Use model-orders.php for order retrieval functions

$pageTitle = "Orders by Customer";
include 'view-header.php';

// Enable error reporting for debugging
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Check if customer_id is passed via GET
$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : null;

// If a valid customer ID is provided
if ($customer_id && $customer_id > 0) {
    $orders = selectOrdersByCustomer($customer_id); // Fetch orders for the specific customer

    // If orders exist, display them
    if ($orders && $orders->num_rows > 0) {
        include 'view-orders-by-customer.php'; // Order listing template
    } else {
        echo "<p>No orders found for this customer.</p>";
    }
} else {
    echo "<p>Invalid Customer ID. Please provide a valid Customer ID.</p>";
}

include 'view-footer.php';
?>
