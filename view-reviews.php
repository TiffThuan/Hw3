<div class="reviews">
    <h2>Product Reviews</h2>
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
