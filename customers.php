


<?php
require_once('util-db.php');
require_once('model-customers.php');

$pageTitle = "Customers"; 
include 'view-header.php';

$customers = selectCustomers();
if ($customers && $customers->num_rows > 0) {
    include 'view-customers.php'; 
} else {
    echo "<p>No customers found.</p>";
}

include 'view-footer.php';
?>
