<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders";
include 'view-header.php';

// Check if a product_id is passed via the query string
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Fetch orders, optionally filtered by product_id
if ($product_id > 0) {
    // If product_id is provided, get only the orders for that product
    $orders = selectOrdersByProduct($product_id);
} else {
    // Otherwise, get all orders
    $orders = selectOrders();
}

include 'view-orders.php';
include 'view-footer.php';
?>
