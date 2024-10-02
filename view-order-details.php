<h1>Order Details</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($detail = $orderDetails->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($detail['price']); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

