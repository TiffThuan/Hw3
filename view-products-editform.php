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
                    <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                    
                    <div class="mb-3">
                        <label for="product_name">Product Name:</label>
                        <select name="product_name" class="form-control" required>
                            <option value="" disabled>Select a product</option>
                            <?php
                            // Include the model to access the selectProducts function
                            require_once 'model-products.php';  // Ensure the path is correct

                            // Call the function to get all products
                            $products = selectProducts();

                            // Check how many products were returned
                            if ($products->num_rows === 0) {
                                echo "<option value=\"\">No products available</option>";
                            } else {
                                while ($row = $products->fetch_assoc()) {
                                    $selected = ($row['productid'] == $product['productid']) ? 'selected' : '';
                                    echo "<option value=\"" . htmlspecialchars($row['productid']) . "\" $selected>" . htmlspecialchars($row['product_name']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="product_description">Description:</label>
                        <textarea name="product_description" class="form-control" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
