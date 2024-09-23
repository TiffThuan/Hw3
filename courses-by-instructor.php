<?php

require_once ('util-db.php');
require_once('model-courses-by-instructor.php');

$pageTitle = "Course by Instructor";
include 'view-header.php';
$instructors = selectCoursesByInstructor($_Get['id']);
include 'view courses-by-instructor.php;
include 'view-footer.php';
?>
