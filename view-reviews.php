<div class="row">
    <div class="col">
        <h1>Product Reviews</h1>
    </div>
    <div class="col-auto">
        <!-- Add the hyperlink to the product list page -->
        <a href="products.php" class="btn btn-info">View Product List</a>
    </div>
    <div class="col-auto">
        <?php include "view-reviews-newform.php"; ?> <!-- Form to add a new review -->
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <?php while ($review = $reviews->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h5>
                        <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                        <div>
                            <!-- Edit Button -->
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editReviewModal<?php echo $review['review_id']; ?>">Edit</button>
                            <?php include "view-reviews-editform.php"; ?> <!-- Edit Modal -->
                            
                            <!-- Delete Button -->
                            <form method="POST" action="reviews.php" class="d-inline">
                                <input type="hidden" name="actionType" value="deleteReview">
                                <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php} ?>
    </div>
</div>
