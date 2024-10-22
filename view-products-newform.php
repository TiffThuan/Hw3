<!-- New Product Modal -->
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
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_description">Description:</label>
                        <textarea name="product_description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
