<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$pageTitle = "Orders";
include 'view-header.php';
require_once('util-db.php');
require_once('model-orders.php');

// Fetch orders and menu data
$orders = selectOrders(); 
$menuPercentages = calculateMenuPercentages(); 

// Check if an order_id is passed to display its details
$orderDetails = [];
if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $orderDetails = selectOrderDetails(intval($_GET['order_id']));
}

// Include the orders view
include 'view-orders.php';
include 'view-footer.php';
?>
