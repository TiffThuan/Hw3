<h1>Order Details for Order ID: <?php echo htmlspecialchars($order_id); ?></h1>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($orderDetails && $orderDetails->num_rows > 0) {
                while ($detail = $orderDetails->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($detail['price']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity'] * $detail['price']); ?></td>
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
