<?php
require_once('util-db.php');
require_once('model-customers.php');

$pageTitle = "Customers";
include 'view-header.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actionType'])) {
    $action = $_POST['actionType'];
    $cid = $_POST['cid'] ?? null;
    $success = false;

    if ($action === "Add") {
        if (!empty($_POST['cFName']) && !empty($_POST['cLName']) && !empty($_POST['cEmail']) && !empty($_POST['cPhone'])) {
            $success = insertCustomers($_POST['cFName'], $_POST['cLName'], $_POST['cEmail'], $_POST['cPhone']);
        }
    } elseif ($action === "Edit" && $cid) {
        if (!empty($_POST['cFName']) && !empty($_POST['cLName']) && !empty($_POST['cEmail']) && !empty($_POST['cPhone'])) {
            $success = updateCustomers($_POST['cFName'], $_POST['cLName'], $_POST['cEmail'], $_POST['cPhone'], $cid);
        }
    } elseif ($action === "Delete" && $cid) {
        $success = deleteCustomers($cid);
    }

    echo '<div class="alert alert-' . ($success ? 'success' : 'danger') . '" role="alert">'
        . ($success ? ucfirst($action) . ' successful.' : 'Error during ' . strtolower($action) . '.')
        . '</div>';
}

// Fetch data
$customers = selectCustomers();
$customersWithOrders = getCustomerOrderDetails();
$newCustomersData = getNewCustomersOverTime();
$months = array_column($newCustomersData, 'month');
$newCustomers = array_column($newCustomersData, 'new_customers');

// Include the view
include 'view-customers.php';
include 'view-footer.php';
?>
