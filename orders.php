<?php
require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders"; 
include 'view-header.php';

ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Fetch all orders without filtering by customer
$orders = selectOrders();

if ($orders->num_rows === 0) {
    echo "No orders found!";
} else {
    include 'view-orders.php'; 
}

include 'view-footer.php';
?>
