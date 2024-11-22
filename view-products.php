<h1 class="text-center mb-4 text-uppercase" style="color: #6b3e26;">Manage Products</h1>

<!-- Add Product Button -->
<button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

<!-- Add Product Modal -->
<?php include 'view-products-newform.php'; ?>

<!-- Shop Photos Section -->
<div class="mb-5">
    <h2 class="text-center" style="color: #6b3e26;">Our Coffee Shop & Products</h2>
    <div class="row">
        <div class="col-md-4">
            <img src="images/shop1.jpg" alt="Coffee Shop" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;">
        </div>
        <div class="col-md-4">
            <img src="images/shop2.jpg" alt="Coffee Products" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;">
        </div>
        <div class="col-md-4">
            <img src="images/shop3.jpg" alt="Food & Catering" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;">
        </div>
    </div>
</div>

<!-- Display Products -->
<div class="row">
    <?php while ($product = $products->fetch_assoc()) { ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px;">
                <!-- Product Image -->
                <img src="images/products/<?php echo htmlspecialchars($product['productid']); ?>.jpg" 
                     alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                     class="card-img-top" 
                     style="max-height: 200px; object-fit: cover; border-radius: 10px 10px 0 0;">
                
                <div class="card-body">
                    <!-- Product Details -->
                    <h5 class="card-title" style="color: #6b3e26; font-weight: bold;"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($product['product_description']); ?></p>
                    <p class="card-text text-success">Price: $<?php echo htmlspecialchars($product['price']); ?></p>

                    <!-- Order Button -->
                    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#orderProductModal<?php echo $product['productid']; ?>">Order Now</button>

                    <!-- Edit Product Button -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['productid']; ?>">Edit</button>

                    <!-- Delete Product Button -->
                    <form method="POST" action="products.php" style="display:inline;">
                        <input type="hidden" name="actionType" value="deleteProduct">
                        <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Modal for Individual Product -->
        <div class="modal fade" id="orderProductModal<?php echo $product['productid']; ?>" tabindex="-1" aria-labelledby="orderProductModalLabel<?php echo $product['productid']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderProductModalLabel<?php echo $product['productid']; ?>">Order <?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="orders.php">
                            <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                            <div class="mb-3">
                                <label for="customerName" class="form-label">Your Name</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="specialRequest" class="form-label">Special Request</label>
                                <textarea name="special_request" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <?php include 'view-products-editform.php'; ?>
    <?php } ?>
</div>

<!-- Catering Order Form -->
<div class="mt-5">
    <h2 class="text-center" style="color: #6b3e26;">Catering Services</h2>
    <div class="card shadow-sm border-0" style="border-radius: 10px;">
        <div class="card-body">
            <form method="POST" action="catering-orders.php">
                <div class="mb-3">
                    <label for="eventName" class="form-label">Event Name</label>
                    <input type="text" name="event_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="eventDate" class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="guestCount" class="form-label">Number of Guests</label>
                    <input type="number" name="guest_count" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="specialRequests" class="form-label">Special Requests</label>
                    <textarea name="special_requests" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Catering Request</button>
            </form>
        </div>
    </div>
</div>
