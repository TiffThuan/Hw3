<!-- Edit Review Form -->
<form method="POST" action="reviews.php" class="d-inline">
    <input type="hidden" name="actionType" value="editReview">
    <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
    <div class="mb-3">
        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo $review['rating']; ?>" min="1" max="5" required>
    </div>
    <div class="mb-3">
        <label for="review_text">Review:</label>
        <textarea name="review_text" required><?php echo htmlspecialchars($review['review_text']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Edit Review</button>
</form>
