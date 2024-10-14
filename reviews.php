<?php
require_once('model-reviews.php');
require_once('model-products.php');

$pageTitle = "King Coffee Shop Reviews";
include 'view-header.php';

// Handle review actions
if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case 'submitReview':
            // Handle review submission
            $product_id = $_POST['product_id'];
            $customer_id = $_POST['customer_id']; // Replace with actual customer ID
            $rating = $_POST['rating'];
            $review_text = $_POST['review_text'];
            if (insertReview($product_id, $customer_id, $rating, $review_text)) {
                echo '<div class="alert alert-success">Review added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error adding review.</div>';
            }
            break;

        case 'editReview':
            // Handle review editing
            $review_id = $_POST['review_id'];
            $rating = $_POST['rating'];
            $review_text = $_POST['review_text'];
            if (updateReview($review_id, $rating, $review_text)) {
                echo '<div class="alert alert-success">Review updated successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error updating review.</div>';
            }
            break;

        case 'deleteReview':
            // Handle review deletion
            $review_id = $_POST['review_id'];
            if (deleteReview($review_id)) {
                echo '<div class="alert alert-success">Review deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error deleting review.</div>';
            }
            break;
    }
}

$reviews=selectReviews(product_id);
<?php include 'view-reviews.php'; ?>


<?php include 'view-footer.php'; ?>
