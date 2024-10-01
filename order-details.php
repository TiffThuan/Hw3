<?php
require_once ('util-db.php');
require_once('model-order-details.php');

$pageTitle = "Order Details"; 
include 'view-header.php';

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;
if ($order_id) {
    $orderDetails = selectOrderDetails($order_id);
    if ($orderDetails->num_rows === 0) {
        echo "<p>No details found for this order.</p>";
    } else {
        include 'view-order-details.php'; 
    }
} else {
    echo "Invalid Order ID. Please provide a valid Order ID.";
}

include 'view-footer.php';
?>
