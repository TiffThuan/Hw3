<h1 class="text-center mb-5 text-uppercase" style="color: #6b3e26;">Our Products</h1>

<!-- Add Product Button -->
<div class="text-center mb-4">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
</div>

<!-- Add Product Modal -->
<?php include 'view-products-newform.php'; ?>

<!-- Products Section -->
<section>
    <h2 class="text-center mb-4" style="color: #6b3e26;">Explore Our Menu</h2>
    <div class="container">
        <div class="row g-4">
            <?php 
            $productIds = []; // To track displayed products and avoid duplicates
            while ($product = $products->fetch_assoc()) { 
                if (in_array($product['productid'], $productIds)) {
                    continue; // Skip duplicate product
                }
                $productIds[] = $product['productid']; // Track displayed product IDs
            ?>
                <!-- Product Grid Item -->
                <div class="col-lg-4 col-md-6">
                    <div class="position-relative overflow-hidden rounded shadow-sm">
                        <!-- Product Image -->
                        <img src="images/products/<?php echo htmlspecialchars($product['productid']); ?>.jpg" 
                             alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                             class="img-fluid w-100" 
                             style="height: 250px; object-fit: cover;">

                        <!-- Overlay with Product Info -->
                        <div class="position-absolute top-50 start-50 translate-middle text-center w-100 bg-dark bg-opacity-75 p-3 text-white">
                            <h5 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                            <p class="mb-2 small"><?php echo htmlspecialchars($product['product_description']); ?></p>
                            <p class="text-warning fw-bold">Price: $<?php echo htmlspecialchars($product['price']); ?></p>

                            <!-- Order Button -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderProductModal<?php echo $product['productid']; ?>">Order Now</button>
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
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="specialRequest" class="form-label">Special Request</label>
                                        <textarea name="special_request" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Cart and Payment Section -->
<section class="mt-5">
    <h2 class="text-center mb-4" style="color: #6b3e26;">Your Cart</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Cart Items Table -->
                <table class="table table-bordered text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Cart Row -->
                        <?php 
                        // Replace with actual cart fetching logic
                        foreach ($cartItems as $cartItem) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cartItem['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($cartItem['quantity']); ?></td>
                                <td>$<?php echo number_format($cartItem['total_price'], 2); ?></td>
                                <td>
                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="actionType" value="removeFromCart">
                                        <input type="hidden" name="cartItemId" value="<?php echo $cartItem['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <!-- Payment Summary -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Payment Summary</h5>
                        <p class="card-text">Subtotal: $<?php echo number_format($cartSubtotal, 2); ?></p>
                        <p class="card-text">Tax: $<?php echo number_format($cartTax, 2); ?></p>
                        <p class="card-text">Total: $<?php echo number_format($cartTotal, 2); ?></p>
                        <form method="POST" action="checkout.php">
                            <button type="submit" class="btn btn-success w-100">Proceed to Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
