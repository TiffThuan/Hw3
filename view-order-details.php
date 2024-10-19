<h1>Order Details</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($orderDetails && $orderDetails->num_rows > 0) {
                while ($orderDetail = $orderDetails->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orderDetail['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['quantity']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($orderDetail['price'], 2)); ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>No order details found.</td></tr>";
            }
            ?>  
        </tbody>
    </table>
</div>

<!-- Back Button -->
<a href="view-orders.php" class="btn btn-secondary">Back to Orders</a>
