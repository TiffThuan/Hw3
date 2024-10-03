<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once ('util-db.php');
require_once('model-products.php');

$pageTitle = "Products"; 
include 'view-header.php';

$products = selectProducts();
include 'view-products.php'; 
include 'view-footer.php';
?>

