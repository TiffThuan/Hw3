
<?php
require_once ('util-db.php');
require_once('model-orders-by-customer.php');

$pageTitle = "Orders by Customer"; // Update title
include 'view-header.php';

$customer_id = $_GET['id']; // Get the customer_id from the URL
$orders = selectOrdersByCustomer($customer_id); // Pass the customer_id to the function
include 'view-orders-by-customer.php'; 
include 'view-footer.php';
?>
