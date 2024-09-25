

  <?php
require_once ('util-db.php');
require_once('model-instructors-with-courses.php'); // Corrected filename

$pageTitle = "Instructors With Courses";
include 'view-header.php';
$instructors = selectInstructors();
include 'view-instructors-with-courses.php'; // Corrected file path
include 'view-footer.php';
?>
