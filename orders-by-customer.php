<?php
require_once('util-db.php');
require_once('model-orders-by-customer.php'); 

$pageTitle = "Orders by Customer";
include 'view-header.php';

ini_set('display_errors', 1); 
error_reporting(E_ALL);

$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : null;

echo "<p>Debug: Customer ID fetched from URL is: {$customer_id}</p>"; // Debugging line

if ($customer_id && $customer_id > 0) {
    $orders = selectOrdersByCustomer($customer_id);

    if ($orders && $orders->num_rows > 0) {
        include 'view-orders-by-customer.php'; // Display the orders
    } else {
        echo "<p>No orders found for this customer.</p>";
    }
} else {
    echo "<p>Invalid Customer ID. Please provide a valid Customer ID.</p>";
}

include 'view-footer.php';
?>
