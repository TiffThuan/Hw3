<?php
require_once('util-db.php');
require_once('model-orders.php');

ini_set('display_errors', 1); // Enable error reporting for debugging
error_reporting(E_ALL);

$pageTitle = "Orders"; 
include 'view-header.php';

$orders = selectOrders();

if (!$orders || $orders->num_rows == 0) {
    echo "No orders found or query failed!";
} else {
    include 'view-orders.php';
}

include 'view-footer.php';
?>
