<?php
require_once('util-db.php');
require_once('model-customers.php');

$pageTitle = "Customers";
include 'view-header.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['actionType'])) {
    $action = $_POST['actionType'];
    $cid = $_POST['cid'] ?? null;
    $success = false;

    if ($action === "Add") {
        // Ensure all required fields are present
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

    // Provide feedback
    echo '<div class="alert alert-' . ($success ? 'success' : 'danger') . '" role="alert">'
        . ($success ? ucfirst($action) . ' successful.' : 'Error during ' . strtolower($action) . '.')
        . '</div>';
}

// Fetch all customers for display
$customers = selectCustomers();

// Include the view
include 'view-customers.php';
include 'view-footer.php';
?>
