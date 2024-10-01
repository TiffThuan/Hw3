
<?php
require_once('util-db.php');
require_once('model-customers-with-orders.php'); 

$pageTitle = "Customers with Orders";
include 'view-header.php';
$customers = selectCustomers(); // Fetches all customers first before selectCustomersWithOrders()

include 'view-customers-with-orders.php';
include 'view-footer.php';
?>
