<?php
require_once('model-reviews.php');
require_once('model-products.php'); // To get product details

$pageTitle = "Product Reviews";
include 'view-header.php';

// Handle review submission
if (isset($_POST['actionType'])) {
    switch ($_POST['actionType']) {
        case 'submitReview':
            // Call insertReview()
            break;
        case 'editReview':
            // Call updateReview()
            break;
        case 'deleteReview':
            // Call deleteReview()
            break;
    }
}

// Fetch reviews for the specified product
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$reviews = fetchReviewsByProduct($product_id);
?>

<h1>Reviews for Product ID: <?php echo $product_id; ?></h1>
<div class="reviews">
    <ul>
        <?php if ($reviews && $reviews->num_rows > 0) { ?>
            <?php while ($review = $reviews->fetch_assoc()) { ?>
                <li>
                    <strong>Rating:</strong> <?php echo $review['rating']; ?> 
                    <br>
                    <strong>Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?>
                    <br>
                    <button data-bs-toggle="modal" data-bs-target="#editReviewModal<?php echo $review['review_id']; ?>">Edit</button>
                    <button onclick="confirmDelete(<?php echo $review['review_id']; ?>)">Delete</button>
                    <?php include 'view-reviews-editform.php'; ?> <!-- Include edit form -->
                </li>
            <?php } ?>
        <?php } else { ?>
            <li>No reviews yet.</li>
        <?php } ?>
    </ul>
</div>

<?php include 'view-reviews-newform.php'; ?> <!-- Include add form -->
<?php include 'view-footer.php'; ?>
