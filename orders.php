<?php
require_once('util-db.php');
require_once('model-orders.php'); // Use model-orders.php for order retrieval functions

$pageTitle = "Orders";
include 'view-header.php';

// Enable error reporting for debugging
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Fetch all orders without customer_id check
$orders = selectOrders(); 

// Check if any orders exist, if not show a message
if ($orders && $orders->num_rows > 0) {
    include 'view-orders.php'; // This is your order listing template
} else {
    echo "No orders found!";
}

include 'view-footer.php';
