
  <?php
require_once ('util-db.php');
require_once('model-courses-by-instructor.php');

$pageTitle = "Courses by Instructor";
include 'view-header.php';

$instructors = selectCoursesByInstructor($_GET['id']);
include 'view-courses-by-instructor.php'; 
include 'view-footer.php';
?>
