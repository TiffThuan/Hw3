<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('util-db.php');
require_once('model-orders-by-customer.php');



$pageTitle = "Orders by Customer";
include 'view-header.php';

// Debugging: Show all query parameters
echo "<pre>";
print_r($_GET);
echo "</pre>";

// Check if customer_id is set and valid
if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']); // Convert to integer
    echo "Debug: Customer ID fetched from URL is: " . $customer_id . "<br>"; // Debugging output

    if ($customer_id > 0) {
        // Fetch orders by customer ID
        $orders = selectOrdersByCustomer($customer_id);
        
        if ($orders && $orders->num_rows > 0) {
            include 'view-orders-by-customer.php';
        } else {
            echo "<p>No orders found for this customer.</p>";
        }
    } else {
        echo "<p>Invalid Customer ID. Please provide a valid Customer ID.</p>";
    }
} else {
    echo "<p>Invalid or missing customer ID.</p>";
}

include 'view-footer.php';
?>
