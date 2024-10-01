<?php
require_once('util-db.php');
require_once('model-customers-with-orders.php');

ini_set('display_errors', 1); // Enable error reporting for debugging
error_reporting(E_ALL);

$pageTitle = "Customers with Orders";
include 'view-header.php';

$customers = selectCustomers();

if (!$customers || $customers->num_rows == 0) {
    echo "No customers found or query failed!";
} else {
    include 'view-customers-with-orders.php';
}

include 'view-footer.php';
?>
