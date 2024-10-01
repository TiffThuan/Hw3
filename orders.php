<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders"; 
include 'view-header.php';

$orders = selectOrders();

include 'view-orders.php'; 

include 'view-footer.php';
?>
