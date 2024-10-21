<?php
require_once ('util-db.php');
require_once('model-products.php'); // Use a model for products

$pageTitle = "Products"; 
include 'view-header.php';

// Handle product actions (add, edit, delete)
if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case 'addProduct':
            if (insertProduct($_POST['pName'], $_POST['pDescription'], $_POST['pPrice'])) {
                echo '<div class="alert alert-success" role="alert">Product added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error adding product.</div>';
            }
            break;

        case 'editProduct':
            if (isset($_POST['pID'], $_POST['pName'], $_POST['pDescription'], $_POST['pPrice'])) {
                if (updateProduct($_POST['pID'], $_POST['pName'], $_POST['pDescription'], $_POST['pPrice'])) {
                    echo '<div class="alert alert-success" role="alert">Product updated successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error updating product.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Missing data for editing.</div>';
            }
            break;

        case 'deleteProduct':
            if (isset($_POST['pID'])) {
                if (deleteProduct($_POST['pID'])) {
                    echo '<div class="alert alert-success" role="alert">Product deleted successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error deleting product.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Invalid or missing product ID.</div>';
            }
            break;
    }
}

// Fetch and display products
$products = selectProducts();
include 'view-products.php'; // Assuming this is the view for listing products
include 'view-footer.php';
?>
