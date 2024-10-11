<!-- Edit Review Modal -->
<div class="modal fade" id="editReviewModal<?php echo $review['review_id']; ?>" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReviewModalLabel">Edit Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form method="POST" action="reviews.php">
                    <input type="hidden" name="actionType" value="editReview">
                    <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                    <div>
                        <label for="rating">Rating:</label>
                        <input type="number" name="rating" value="<?php echo $review['rating']; ?>" min="1" max="5" required>
                    </div>
                    <div>
                        <label for="review_text">Review:</label>
                        <textarea name="review_text" required><?php echo htmlspecialchars($review['review_text']); ?></textarea>
                    </div>
                    <button type="submit">Update Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
