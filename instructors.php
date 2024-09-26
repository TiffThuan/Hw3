
<?php
require_once ('util-db.php');
require_once('model-instructors.php'); // Added .php

$pageTitle = "Instructors";
include 'view-header.php';
$instructors = selectInstructors();
include 'view-instructors.php'; // Closing quote added
include 'view-footer.php';
?>
