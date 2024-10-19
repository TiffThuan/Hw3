<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

var_dump($_POST);  // Add this to inspect form data

require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders";
include 'view-header.php';

if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case "Add":
            if (isset($_POST['order_date'], $_POST['cFName'], $_POST['cLName'], $_POST['email'], $_POST['total_amount'])) {
                if (insertOrder($_POST['order_date'], $_POST['cFName'], $_POST['cLName'], $_POST['email'], $_POST['total_amount'])) {
                    echo '<div class="alert alert-success" role="alert">Order added...</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error adding order...</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Missing data for adding.</div>';
            }
            break;

        case "Edit":
            if (isset($_POST['order_id'], $_POST['order_date'], $_POST['cFName'], $_POST['cLName'], $_POST['email'], $_POST['total_amount'])) {
                if (updateOrder($_POST['order_id'], $_POST['order_date'], $_POST['cFName'], $_POST['cLName'], $_POST['email'], $_POST['total_amount'])) {
                    echo '<div class="alert alert-success" role="alert">Order edited...</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error editing order...</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Missing data for editing.</div>';
            }
            break;

        case "Delete":
            if (isset($_POST['order_id'])) {
                if (deleteOrder($_POST['order_id'])) {
                    echo '<div class="alert alert-success" role="alert">Order deleted...</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error deleting order...</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Invalid or missing order ID.</div>';
            }
            break;
    }
}


$orders = selectOrders(); 

include 'view-orders.php';
include 'view-footer.php';
?>
