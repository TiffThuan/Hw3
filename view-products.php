<h1 class="text-center mb-4">Products with Orders</h1>
<div class="container">
    <div class="row">
        <?php while ($product = $products->fetch_assoc()) { ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($product['product_description']); ?>
                        </p>
                        <p class="card-text">
                            <strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?>
                        </p>
                        <?php if (!empty($product['order_id'])) { ?>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Order ID:</strong> <?php echo htmlspecialchars($product['order_id']); ?>,
                                    <strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?>,
                                    <strong>Total:</strong> $<?php echo htmlspecialchars($product['order_price']); ?>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <p>No orders found for this product.</p>
                        <?php } ?>
                        
                        <!-- Add Review Button -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal<?php echo $product['productid']; ?>">
                            Add Review
                        </button>

                        <!-- Add Review Modal -->
                        <div class="modal fade" id="addReviewModal<?php echo $product['productid']; ?>" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addReviewModalLabel">Add Review for <?php echo htmlspecialchars($product['product_name']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="reviews.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product['productid']; ?>">
                                            <input type="hidden" name="customer_id" value="1"> <!-- Replace with actual customer ID -->
                                            <div class="mb-3">
                                                <label for="rating">Rating:</label>
                                                <input type="number" name="rating" min="1" max="5" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="review_text">Review:</label>
                                                <textarea name="review_text" required></textarea>
                                            </div>
                                            <button type="submit" name="actionType" value="submitReview" class="btn btn-primary">Submit Review</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Review Modal (You can implement this similarly) -->
                        <!-- Include logic for displaying existing reviews with edit and delete options here -->

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
