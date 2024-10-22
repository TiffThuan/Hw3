<!-- Edit Review Modal -->
<div class="modal fade" id="editReviewModal<?php echo $review['review_id']; ?>" tabindex="-1" aria-labelledby="editReviewModalLabel<?php echo $review['review_id']; ?>" aria-hidden="true">
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
            <input type="hidden" name="product_id" value="<?php echo $review['product_id']; ?>"> <!-- Include product_id -->

            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating" value="<?php echo $review['rating']; ?>" min="1" max="5" required>
            </div>

            <div class="mb-3">
                <label for="review_text" class="form-label">Review</label>
                <textarea class="form-control" id="review_text" name="review_text" required><?php echo htmlspecialchars($review['review_text']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
