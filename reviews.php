<?php
require_once('model-reviews.php');
require_once('model-products.php'); // To get product details

$pageTitle = "Product Reviews";
include 'view-header.php';

// Handle review submission
if (isset($_POST['actionType']) && $_POST['actionType'] === 'submitReview') {
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id']; // Replace with actual customer ID from session
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    if (insertReview($product_id, $customer_id, $rating, $review_text)) {
        echo '<div class="alert alert-success">Review added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error adding review.</div>';
    }
}

// Fetch reviews for the specified product
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$reviews = fetchReviewsByProduct($product_id);
?>

<!-- Display reviews and add review form as before -->

<h1>Reviews for Product ID: <?php echo $product_id; ?></h1>
<div class="reviews">
    <ul>
        <?php if ($reviews && $reviews->num_rows > 0) { ?>
            <?php while ($review = $reviews->fetch_assoc()) { ?>
                <li>
                    <strong>Rating:</strong> <?php echo $review['rating']; ?> 
                    <br>
                    <strong>Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?>
                </li>
            <?php } ?>
        <?php } else { ?>
            <li>No reviews yet.</li>
        <?php } ?>
    </ul>
</div>

<!-- Add Review Form -->
<h2>Add Your Review</h2>
<form method="POST" action="reviews.php">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="customer_id" value="1"> <!-- Replace with actual customer ID from session -->
    <div>
        <label for="rating">Rating:</label>
        <input type="number" name="rating" min="1" max="5" required>
    </div>
    <div>
        <label for="review_text">Review:</label>
        <textarea name="review_text" required></textarea>
    </div>
    <button type="submit">Submit Review</button>
</form>

<?php include 'view-footer.php'; ?>
