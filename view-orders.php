<h1>Orders</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Fetch orders
        if ($orders->num_rows == 0) {
            echo "<tr><td colspan='5'>No orders found.</td></tr>"; // Debugging step
        } else {
            while ($order = $orders->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['total_amount']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>
