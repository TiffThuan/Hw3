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
    if ($orders && $orders->num_rows > 0) {
        while ($order = $orders->fetch_assoc()) {
    ?>
            <tr>
                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                <td><?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></td>
                <td><?php echo htmlspecialchars($order['total_amount']); ?></td>

                <td>
                    <!-- Form for viewing order details -->
                    <form method="POST" action="order-details.php">
                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        <button type="submit" class="btn btn-info">View Details</button>
                    </form>
                </td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='5'>No orders found!</td></tr>";
    }
    ?>
</tbody>

    </table>
</div>
