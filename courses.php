<?php

require_once ('util-db.php');
require_once('model-courses');

$pageTitle = "Courses";
include 'view-header.php';
$courses = selectCourses();
include 'view-courses.php;
include 'view-footer.php';
?>
