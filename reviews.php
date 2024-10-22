<?php
require_once('model-reviews.php');
require_once('model-products.php');

$pageTitle = "King Coffee Shop Reviews";
include 'view-header.php';

// Handle review actions
if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case 'insertReview':
            // Handle review submission
            $product_id = $_POST['product_id'];
            $customer_id = $_POST['customer_id'] ?? null; // Allow customer_id to be null
            $rating = $_POST['rating'];
            $review_text = $_POST['review_text'];
        
            // Log the values before attempting to insert
            error_log("Adding review: Product ID: $product_id, Customer ID: $customer_id, Rating: $rating, Review Text: $review_text");
        
            if (insertReview($product_id, $customer_id, $rating, $review_text)) {
                echo '<div class="alert alert-success">Review added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error adding review.</div>';
            }
            break;


        case 'editReview':
            $review_id = $_POST['review_id'];
            $rating = $_POST['rating'];
            $review_text = $_POST['review_text'];

            if (updateReview($review_id, $product_id, $rating, $review_text)) {
                echo '<div class="alert alert-success">Review updated successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error updating review.</div>';
            }
            break;

        case 'deleteReview':
            $review_id = $_POST['review_id'];
            if (deleteReview($review_id)) {
                echo '<div class="alert alert-success">Review deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error deleting review.</div>';
            }
            break;
    }
}

// Fetch reviews (consider removing product_id if you want all reviews)
$reviews = selectReviews(); 
include 'view-reviews.php'; // Include reviews view

include 'view-footer.php';
?>
