<?php
require_once('util-db.php'); // Your database connection utilities
require_once('model-order-details.php'); // Use model-order-details.php for order retrieval functions

$pageTitle = "Order Details";
include 'view-header.php';

// Enable error reporting for debugging
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Check for order_id in POST request
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

if ($order_id) {
    $orderDetails = selectOrderDetails($order_id);

    if ($orderDetails && $orderDetails->num_rows > 0) {
        include 'view-order-details.php'; // Template to display the details of the order
    } else {
        echo "<p>No details found for this order.</p>";
    }
} else {
    echo "<p>Invalid Order ID. Please provide a valid Order ID.</p>";
}

include 'view-footer.php';
?>
