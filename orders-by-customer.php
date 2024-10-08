<?php
require_once('util-db.php'); 
require_once('model-orders-by-customer.php'); 

$pageTitle = "Orders by Customer"; // Page title consistency
include 'view-header.php'; // Include the header


if (isset($_POST['customer_id']) && !empty($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']); 
    $orders = selectOrdersByCustomer($customer_id); 

    // Check if there are orders returned
    if ($orders && $orders->num_rows > 0) {
        include 'view-orders-by-customer.php';
    } else {
        echo "<p>No orders found for this customer.</p>"; 
    }
} else {
    echo "<p>Please provide a valid customer ID.</p>";
}

include 'view-footer.php'; 
?>

