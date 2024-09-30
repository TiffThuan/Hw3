

<?php
require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders"; 
include 'view-header.php';

$orders = selectOrders();
if ($orders && $orders->num_rows > 0) {
    include 'view-orders.php'; 
} else {
    echo "<p>No orders found.</p>";
}

include 'view-footer.php';
?>
