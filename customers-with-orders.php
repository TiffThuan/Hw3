
<?php
require_once('util-db.php');
require_once('model-customers-with-orders.php'); // Corrected model import

$pageTitle = "Customers with Orders";
include 'view-header.php';

$customersWithOrders = selectCustomersWithOrders();
include 'view-customers-with-orders.php';
include 'view-footer.php';
?>
