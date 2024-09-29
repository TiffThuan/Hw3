

<?php
require_once('util-db.php');
require_once('model-sections-by-course.php');

$pageTitle = "Sections by Course"; // Ensure consistency in title casing
include 'view-header.php';

if (isset($_POST['cid']) && !empty($_POST['cid'])) { // Check if 'cid' is set and not empty
    $cid = intval($_POST['cid']); // Sanitize input to an integer
    $sections = selectSectionsByCourse($cid); // Call the function with sanitized input
    include 'view-sections-by-course.php'; // Include the view to display sections
} else {
    echo "<p>Please provide a valid course ID.</p>"; // Provide user feedback if 'cid' is not set
}

include 'view-footer.php';
?>
