

<?php
require_once ('util-db.php');
require_once('model-customers.php'); // Renamed

$pageTitle = "Customers"; // Update title
include 'view-header.php';
$customers = selectCustomers(); // Fetch customers
include 'view-customers.php'; 
include 'view-footer.php';
?>
