<div class="row">
    <div class="col">
        <h1>Product Reviews</h1>
    </div>
    <div class="col-auto">
        <?php include "view-reviews-newform.php"; ?> <!-- Form to add a new review -->
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Review ID</th>
                <th>Rating</th>
                <th>Review Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $reviews = selectReviews(); // Fetch all reviews
            while ($review = $reviews->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($review['review_id']); ?></td>
                    <td><?php echo htmlspecialchars($review['rating']); ?></td>
                    <td><?php echo htmlspecialchars($review['review_text']); ?></td>
                    <td>
                        <!-- Edit button/modal -->
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editReviewModal<?php echo $review['review_id']; ?>">Edit</button>
                        <?php include "view-reviews-editform.php"; ?> <!-- Modal for editing the review -->

                        <!-- Delete button -->
                        <form method="POST" action="reviews.php" class="d-inline">
                            <input type="hidden" name="actionType" value="deleteReview">
                            <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
