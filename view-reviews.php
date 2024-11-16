<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Us & Reviews - King Coffee Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="row">
        <div class="col">
            <h1>Find Us & Reviews</h1>
        </div>
        <div class="col-auto">
            <a href="products-with-reviews.php" class="btn btn-info">View Reviews by Product</a>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome to King Coffee Shop</h1>
        <div class="row mb-5">
            <div class="col-md-6">
                <h2>Our Location</h2>
                <p>123 Coffee Lane, Brewtown, USA</p>
                <p><strong>Opening Hours:</strong></p>
                <ul>
                    <li>Monday - Friday: 7:00 AM - 8:00 PM</li>
                    <li>Saturday: 8:00 AM - 10:00 PM</li>
                    <li>Sunday: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Mission, Vision, and Values</h2>
                <p><strong>Mission:</strong> To brew happiness, one cup at a time.</p>
                <p><strong>Vision:</strong> To become the most beloved coffee shop in the community.</p>
                <p><strong>Values:</strong> Quality, Community, Sustainability.</p>
            </div>
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
                                <?php include "view-reviews-editform.php"; ?>

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

                <!-- Edit Review Modal -->
                <div class="modal fade" id="editReviewModal<?php echo $review['review_id']; ?>" tabindex="-1" aria-labelledby="editReviewModalLabel<?php echo $review['review_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editReviewModalLabel<?php echo $review['review_id']; ?>">Edit Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="reviews.php">
                                    <div class="mb-3">
                                        <label for="reviewText<?php echo $review['review_id']; ?>" class="form-label">Review Text</label>
                                        <textarea class="form-control" id="reviewText<?php echo $review['review_id']; ?>" name="review_text" rows="3"><?php echo htmlspecialchars($review['review_text']); ?></textarea>
                                    </div>
                                    <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                                    <input type="hidden" name="actionType" value="editReview">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
