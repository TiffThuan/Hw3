<h1>Orders for <?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?></h1>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($orders && $orders->num_rows > 0) {
                while ($order = $orders->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td><a href="order-details.php?order_id=<?php echo $order['order_id']; ?>">View Details</a></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>No orders found for this customer.</td></tr>";
            }
            ?>  
        </tbody>
    </table>
</div>

