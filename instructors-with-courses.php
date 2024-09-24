<?php

require_once ('util-db.php');
require_once('model-instructors-with-courses');

$pageTitle = "Instructors With Courses";
include 'view-header.php';
$instructors = selectInstructors();
include 'view-instructors-with-course.php;
include 'view-footer.php';
?>
