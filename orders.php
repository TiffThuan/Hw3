<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$pageTitle = "Orders";
include 'view-header.php';
require_once('util-db.php');
require_once('model-orders.php');


// Fetch orders and menu data
$orders = selectOrders(); 
$menuPercentages = calculateMenuPercentages(); 

// Handle Add Order Action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actionType']) && $_POST['actionType'] === 'Add') {
    $cFName = $_POST['cFName'] ?? null;
    $cLName = $_POST['cLName'] ?? null;
    $order_date = $_POST['order_date'] ?? null;
    $total_amount = $_POST['total_amount'] ?? null;
    $payment_method = $_POST['payment_method'] ?? null;
    $status = $_POST['status'] ?? null;

    // Validate all required inputs
    if ($cFName && $cLName && $order_date && $total_amount && $payment_method && $status) {
        // Call the function to insert the order
        $success = insertOrder($order_date, $cFName, $cLName, $total_amount, $payment_method, $status);

        if ($success) {
            echo "<div class='alert alert-success'>Order added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to add the order. Please try again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>All fields are required. Please fill out the form completely.</div>";
    }
}

// Check if an order_id is passed to display its details
$orderDetails = [];
if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $orderDetails = selectOrderDetails(intval($_GET['order_id']));
}


// Include the orders view
include 'view-orders.php';
include 'view-footer.php';
?>
