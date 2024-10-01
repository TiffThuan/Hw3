<h1>Orders</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($order = $orders->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                    <td><a href="order-details.php?order_id=<?php echo $order['order_id']; ?>">View Details</a></td>
                </tr>
            <?php
            }
            ?>  
        </tbody>
    </table>
</div>
