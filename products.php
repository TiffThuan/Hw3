<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once ('util-db.php');
require_once('model-products.php');
require_once('model-reviews.php'); // Include reviews model

$pageTitle = "Products"; 
include 'view-header.php';
// Handle form submissions for adding, editing, and deleting products
if (isset($_POST['actionType'])) {
    // Check action type (add, edit, delete)
    if (isset($_POST['actionType'])) {
        switch ($_POST['actionType']) {
            case 'addProduct':
                // Call function to add product
                break;
            case 'editProduct':
                // Call function to update product
                break;
            case 'deleteProduct':
                // Call function to delete product
                break;
        }
    }
}

$products = selectProducts();
include 'view-products.php'; 
include 'view-footer.php';
?>
