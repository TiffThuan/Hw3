<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$pageTitle = "Orders";
include 'view-header.php';
require_once('util-db.php');
require_once('model-orders.php');

// Fetch data from the database

$orders = selectOrders(); // Get the orders
$menuPercentages = calculateMenuPercentages(); // Get menu percentages

// Include the view and footer
include 'view-orders.php';
include 'view-footer.php';
?>
