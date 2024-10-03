<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders";
include 'view-header.php';

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    // Call a new function to get orders based on product_id
    $orders = selectOrdersByProduct($product_id);
} else {
    // Fallback: Show all orders if no product_id is provided
    $orders = selectOrders(); 
}

include 'view-orders.php';
include 'view-footer.php';
?>
