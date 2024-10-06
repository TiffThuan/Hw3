<h1>Orders</h1>
<div class="table-responsive">
    <div class="row mb-3">
        <div class="col">
            <!-- "Add New Order" Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">
                Add New Order
            </button>
        </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Actions</th>
                <th>View Customers</th>
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
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal<?php echo $order['order_id']; ?>">
                                Edit
                            </button>
                            <!-- Delete Button -->
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <input type="hidden" name="actionType" value="Delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </td>
                        <td>
                            <!-- View Customers With Order Button -->
                            <a href="view-customers.php" class="btn btn-info">View Customers With Order</a>
                        </td>
                    </tr>
                    <!-- Include Edit Order Modal -->
                    <?php include "view-orders-editform.php"; ?>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No orders found!</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- New Order Modal -->
<?php include 'view-orders-newform.php'; ?>
