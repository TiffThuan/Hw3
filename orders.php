
<?php
require_once ('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders"; // Update title
include 'view-header.php';
$orders = selectOrders(); // Fetch all orders
include 'view-orders.php'; 
include 'view-footer.php';
?>
