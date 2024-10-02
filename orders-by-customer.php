<?php
require_once('util-db.php');
require_once('model-orders-by-customer.php'); 

ini_set('display_errors', 1); 
error_reporting(E_ALL);

$pageTitle = "Orders by Customer";
include 'view-header.php';

$orders=selectOrders()
    if (! $orders || $orders->num_rows == 0) {
        "<p>No orders found for this customer.</p>"; 
    } else {
        echo include 'view-orders-by-customer.php'; 
    }
} else {
  

include 'view-footer.php';
?>
