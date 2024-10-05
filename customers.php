<?php
require_once ('util-db.php');
require_once('model-customers.php');

$pageTitle = "Customers"; 
include 'view-header.php';

if (isset ($_POST['actionType'])){
switch($_POST['actionType']){
    case "Add":
      if (insertCustomers($_POST['cFName'],$_POST['cLName'],$_POST['cEmail'],$_POST['cPhone'])) {
         echo '<div class = "alert alert-success" role= "alert"> Customer added ....</div>'; 
      } else {
          echo '<div class = "alert alert-danger" role= "alert"> Error added ....</div>';  
      }
    break;

      case "Edit":
      if (editCustomers($_POST['cFName'],$_POST['cLName'],$_POST['cEmail'],$_POST['cPhone'],$_POST['cid'])) {
         echo '<div class = "alert alert-success" role= "alert"> Customer edited ....</div>'; 
      } else {
          echo '<div class = "alert alert-danger" role= "alert"> Error edited ....</div>';  
      }
    break;
    
    case "Delete":
      if (deleteCustomers($_POST['cid'])) {
         echo '<div class = "alert alert-success" role= "alert"> Customer deleted ....</div>'; 
      } else {
          echo '<div class = "alert alert-danger" role= "alert"> Error deleted ....</div>';  
      }
    break;
    }
}
$customers = selectCustomers();
include 'view-customers.php'; 
include 'view-footer.php';
?>
