

  <?php
require_once ('util-db.php');
require_once('model-courses.php');

$pageTitle = "Courses";
include 'view-header.php';
$courses = selectCourses();
include 'view-courses.php'; // Closing quote added
include 'view-footer.php';
?>
