<?php
require_once('util-db.php');
require_once('model-orders.php'); // Use model-orders.php for order retrieval functions

$pageTitle = "Orders by Customer";
include 'view-header.php';

// Enable error reporting for debugging
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Get customer_id from the URL
$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : null;

if ($customer_id) {
    $orders = selectOrdersByCustomer($customer_id);
    
    // Check if any orders exist for this customer
    if ($orders && $orders->num_rows > 0) {
        include 'view-orders-by-customer.php'; // Template to display orders by customer
    } else {
        echo "<p>No orders found for this customer.</p>";
    }
} else {
    echo "<p>Invalid Customer ID. Please provide a valid Customer ID.</p>";
}

include 'view-footer.php';
