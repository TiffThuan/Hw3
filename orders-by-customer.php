<?php
require_once ('util-db.php');
require_once('model-orders-by-customer.php');

$pageTitle = "Orders by Customer"; // Update title
include 'view-header.php';

$orders = selectOrdersByCustomer($_GET['customer_id']); // Use customer_id instead of instructor id
include 'view-orders-by-customer.php'; 
include 'view-footer.php';
?>
