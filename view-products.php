<h1 class="text-center mb-4">Manage Products</h1>
<!-- Add Product Button -->
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="products.php">
                    <input type="hidden" name="actionType" value="addProduct">
                    <div class="mb-3">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_description">Description:</label>
                        <textarea name="product_description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Display Products -->
<div class="row">
    <?php while ($product = $products->fetch_assoc()) { ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($product['product_description']); ?></p>
                    <p class="card-text">Price: $<?php echo htmlspecialchars($product['price']); ?></p>

                    <!-- Edit Product Button -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['productid']; ?>">Edit</button>

                    <!-- Delete Product Button -->
                    <form method="POST" action="products.php" style="display:inline;">
                        <input type="hidden" name="actionType" value="deleteProduct">
                        <input type="hidden" name="product_id" value="<?php echo $product['productid']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>

                    <!-- Edit Product Modal -->
                    <div class="modal fade" id="editProductModal<?php echo $product['productid']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="products.php">
                                        <input type="hidden" name="actionType" value="editProduct">
                                        <input type="hidden" name="product_id" value="<?php echo $product['productid']; ?>">
                                        <div class="mb-3">
                                            <label for="product_name">Product Name:</label>
                                            <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_description">Description:</label>
                                            <textarea name="product_description" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price">Price:</label>
                                            <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
