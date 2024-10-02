<?php
require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Order Details";
include 'view-header.php';

// Fetch order_id from query string
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id) {
    $orderDetails = selectOrderDetails($order_id);
    if ($orderDetails && $orderDetails->num_rows > 0) {
        include 'view-order-details.php'; // Display details
    } else {
        echo "No details found for this order!";
    }
} else {
    echo "Invalid Order ID!";
}

include 'view-footer.php';
?>
