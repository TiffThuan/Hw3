<h1>Orders by Customer</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead> 
        <tbody>
            <?php
            while ($order = $orders->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($order['price']); ?></td>
                </tr>
            <?php
            }
            ?>  
        </tbody>
    </table>
</div>
