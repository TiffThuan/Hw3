<?php
require_once('util-db.php');
require_once('model-customers.php');

$pageTitle = "Customers";
include 'view-header.php';

if (!empty($_POST['actionType'])) {
    $action = $_POST['actionType'];
    $cid = $_POST['cid'] ?? null;
    $success = false;

    if ($action === "Add") {
        $success = insertCustomers($_POST['cFName'], $_POST['cLName'], $_POST['cEmail'], $_POST['cPhone']);
    } elseif ($action === "Edit" && $cid) {
        $success = updateCustomers($_POST['cFName'], $_POST['cLName'], $_POST['cEmail'], $_POST['cPhone'], $cid);
    } elseif ($action === "Delete" && $cid) {
        $success = deleteCustomers($cid);
    }

    echo '<div class="alert alert-' . ($success ? 'success' : 'danger') . '" role="alert">' .
        ($success ? ucfirst($action) . ' successful.' : 'Error during ' . strtolower($action) . '.') .
        '</div>';
}

$customers = selectCustomers();
include 'view-customers.php';
include 'view-footer.php';
?>
