
<div class="container mt-4">
    <h1>Products with Reviews</h1>
    <div class="row">
        <?php while ($product = $productsWithReviews->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card border-primary" style="background-color: #f9f9f9;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['product_description']); ?></p>
                        <p class="card-text"><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                        
                        <h6>Reviews:</h6>
                        <?php if (!empty($product['review_id'])): ?>
                            <p><strong>Rating:</strong> <?php echo htmlspecialchars($product['rating']); ?>/5</p>
                            <p><?php echo htmlspecialchars($product['review_text']); ?></p>
                        <?php else: ?>
                            <p>No reviews yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
