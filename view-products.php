<h1>Products</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($product = $products->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['productid']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_description']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                   
                </tr>
            <?php
            }
            ?>  
        </tbody>
    </table>
</div>
