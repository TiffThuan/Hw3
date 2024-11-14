<?php
// Enable error reporting for debugging
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['actionType'] === 'Add') {
    $cFName = $_POST['cFName'] ?? '';
    $cLName = $_POST['cLName'] ?? '';
    $order_date = $_POST['order_date'] ?? '';
    $total_amount = $_POST['total_amount'] ?? 0.0;
    $payment_method = $_POST['payment_method'] ?? '';
    $status = $_POST['status'] ?? '';

    // Debugging
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    exit;

    if ($cFName && $cLName && $order_date && $total_amount && $payment_method && $status) {
        $success = insertOrder($order_date, $cFName, $cLName, $total_amount, $payment_method, $status);
        echo $success ? "Order added successfully." : "Failed to add order.";
    } else {
        echo "All fields are required.";
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
