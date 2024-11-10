<?php
require_once('util-db.php'); // Ensure database connection utility is included
require_once('model-order-details.php'); // Ensure model with selectOrderDetails() is included

$pageTitle = "Order Details";
include 'view-header.php';

$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

if ($order_id) {
    $orderDetails = selectOrderDetails($order_id);
    if ($orderDetails && $orderDetails->num_rows > 0) {
        include 'view-order-details.php'; // Template to display the details
    } else {
        echo "<p>No details found for this order.</p>";
    }
} else {
    echo "<p>Invalid Order ID. Please provide a valid Order ID.</p>";
}

include 'view-footer.php';

?>
