<?php
require_once('util-db.php');
require_once('model-orders-by-customer.php'); 

ini_set('display_errors', 1); 
error_reporting(E_ALL);

$pageTitle = "Orders by Customer";
include 'view-header.php';

// Step 1: Fetch the customer ID from the URL
if (isset($_GET['customer_id']) && is_numeric($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);

    // Step 2: Fetch the orders for the given customer
    $orders = selectOrdersByCustomer($customer_id);

    if (!$orders || $orders->num_rows == 0) {
        echo "<p>No orders found for this customer.</p>"; 
    } else {
        // Step 3: Include the view to display orders
        include 'view-orders-by-customer.php'; 
    }
} else {
    echo "<p>Invalid or missing customer ID.</p>";
}

include 'view-footer.php';
?>
