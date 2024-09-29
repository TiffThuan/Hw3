

  <?php
require_once ('util-db.php');
require_once('model-sections-by-course.php');

$pageTitle = "Section by Course";
include 'view-header.php';
$sections = selectSectionsByCourse($_POST['cid']); //$_Post to $_POST
include 'view-sections-by-course.php'; // Closing quote added
include 'view-footer.php';
?>
