<h1 class="text-center mb-4">Manage Products</h1>

<!-- Add Product Button -->
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

<!-- Add Product Modal -->
<?php include 'view-products-newform.php'; ?> <!-- Separate new product form -->

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
                        <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>

                    <!-- Edit Product Modal -->
                    <?php include 'view-products-editform.php'; ?> <!-- Separate edit form -->
                </div>
            </div>
        </div>
    <?php } ?>
</div>
