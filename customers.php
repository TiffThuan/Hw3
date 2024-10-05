<?php
require_once ('util-db.php');
require_once('model-customers.php');

$pageTitle = "Customers"; 
include 'view-header.php';

if (isset ($_POST['actionType'])){
switch($_POST['actionType']){
    case "Add":
      insertCustomers($_POST['cFName'],$_POST['cLName'],$_POST['cEmail'],$_POST['cPhone']);
    break;
    }
}
$customers = selectCustomers();
include 'view-customers.php'; 
include 'view-footer.php';
?>
