<?php
require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Order Details";
include 'view-header.php';

// Enable error reporting for debugging
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Get the order_id from the POST data
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

if ($order_id) {
    $orderDetails = selectOrderDetails($order_id);

    if ($orderDetails && $orderDetails->num_rows > 0) {
        include 'view-order-details.php';
    } else {
        echo "<p>No details found for this order.</p>";
    }
} else {
    echo "<p>Invalid Order ID. Please provide a valid Order ID.</p>";
}

include 'view-footer.php';
?>
