<?php
require_once('util-db.php');
require_once('model-details-by-order.php'); // Corrected model import

$pageTitle = "Order Details"; 
include 'view-header.php';

if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    $orderDetails = selectDetailsByOrder($order_id);

    if ($orderDetails && $orderDetails->num_rows > 0) {
        include 'view-details-by-order.php'; // Display details in a view file
    } else {
        echo "<p>No details found for this order.</p>";
    }
} else {
    echo "<p>Invalid order ID provided.</p>";
}

include 'view-footer.php';
?>
