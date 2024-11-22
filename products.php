<?php
require_once('util-db.php');
require_once('model-products.php');

$pageTitle = "Products";
include 'view-header.php';

// Handle product actions (add, edit, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case 'addProduct':
            $name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'product_description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

            if ($name && $description && $price !== false) {
                if (insertProduct($name, $description, $price)) {
                    header("Location: products.php?message=Product added successfully!");
                    exit();
                } else {
                    $error = "Error adding product.";
                }
            } else {
                $error = "Invalid product data.";
            }
            break;

        case 'editProduct':
            $id = filter_input(INPUT_POST, 'productid', FILTER_VALIDATE_INT);
            $name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'product_description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

            if ($id && $name && $description && $price !== false) {
                if (updateProduct($id, $name, $description, $price)) {
                    header("Location: products.php?message=Product updated successfully!");
                    exit();
                } else {
                    $error = "Error updating product.";
                }
            } else {
                $error = "Invalid product data.";
            }
            break;

        case 'deleteProduct':
            $id = filter_input(INPUT_POST, 'productid', FILTER_VALIDATE_INT);

            if ($id) {
                if (deleteProduct($id)) {
                    header("Location: products.php?message=Product deleted successfully!");
                    exit();
                } else {
                    $error = "Error deleting product.";
                }
            } else {
                $error = "Invalid product ID.";
            }
            break;
    }
}

// Fetch products
$currentProducts = selectProducts();
$newArrivals = fetchNewArrivals();

// Display error messages
if (isset($error)) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . htmlspecialchars($error) . 
         '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

// Display success messages
if (isset($_GET['message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . htmlspecialchars($_GET['message']) . 
         '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

include 'view-products.php';
include 'view-footer.php';
?>
