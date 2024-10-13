<?php
require_once('model-reviews.php');
require_once('model-products.php');

$pageTitle = "King Coffee Shop Reviews";
include 'view-header.php';

// Handle review submission, edit, and delete
if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case 'submitReview':
            $product_id = $_POST['product_id'];
            $customer_id = $_POST['customer_id'];
            $rating = $_POST['rating'];
            $review_text = $_POST['review_text'];

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

            if (updateReview($review_id, $rating, $review_text)) {
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

// Fetch reviews for the product
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$reviews = fetchReviewsByProduct($product_id);
?>

<div class="container mt-4">
    <h1>Reviews for Product ID: <?php echo $product_id; ?></h1>
    <ul class="list-group">
        <?php if ($reviews && $reviews->num_rows > 0) { ?>
            <?php while ($review = $reviews->fetch_assoc()) { ?>
                <li class="list-group-item">
                    <strong>Rating:</strong> <?php echo $review['rating']; ?><br>
                    <strong>Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?><br>

                    <!-- Include Edit Form -->
                    <?php include 'view-reviews-editform.php'; ?>

                    <!-- Delete Form -->
                    <form method="POST" action="reviews.php" class="d-inline">
                        <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                        <button type="submit" name="actionType" value="deleteReview" class="btn btn-danger">Delete</button>
                    </form>
                </li>
            <?php } ?>
        <?php } else { ?>
            <li class="list-group-item">No reviews yet.</li>
        <?php } ?>
    </ul>

    <!-- Add Review Form -->
    <?php include 'view-reviews-newform.php'; ?>
</div>

<?php include 'view-footer.php'; ?>
