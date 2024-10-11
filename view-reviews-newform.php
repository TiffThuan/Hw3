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
    <button type="submit" name="actionType" value="submitReview">Submit Review</button>
</form>
