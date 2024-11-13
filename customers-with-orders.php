<?php
require_once('util-db.php');
require_once('model-customers-with-orders.php');

$pageTitle = "Customer Orders";
include 'view-header.php';

if (isset($_GET['customer_id']) && is_numeric($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);
    $orders = selectCustomersWithOrders($customer_id);

    if ($orders->num_rows > 0) {
        include 'view-customers-with-orders.php';
    } else {
        echo "<p class='alert alert-warning'>No orders found for this customer.</p>";
    }
} else {
    echo "<p class='alert alert-danger'>Invalid customer ID.</p>";
}

include 'view-footer.php';
?>
