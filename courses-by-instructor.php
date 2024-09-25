
  <?php
require_once ('util-db.php');
require_once('model-courses-by-instructor.php');

$pageTitle = "Course by Instructor";
include 'view-header.php';

// Correcting $_Get to $_GET
$instructors = selectCoursesByInstructor($_GET['id']);
include 'view-courses-by-instructor.php'; // Closing quote added
include 'view-footer.php';
?>
