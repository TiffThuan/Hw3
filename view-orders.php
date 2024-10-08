<h1>Orders</h1>
<div class="table-responsive">
    <div class="row mb-3">
        <div class="col">
            <!-- Only include the "Add New Order" Button here -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">
                Add New Order
            </button>
        </div>
    </div>

    <!-- Include the New Order Modal here -->
    <?php include 'view-orders-newform.php'; ?>

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
                            <!-- Delete Button -->
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <input type="hidden" name="actionType" value="Delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal<?php echo $order['order_id']; ?>">
                                Edit
                            </button>
                        </td>
                        <td>
                            <form method="POST" action="order-details.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" class="btn btn-info">View Details</button>
                            </form>
                        </td>

                    </tr>

<!--                     <!-- Edit Order Modal -->
                    <div class="modal fade" id="editOrderModal<?php echo $order['order_id']; ?>" tabindex="-1" aria-labelledby="editOrderModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editOrderModalLabel<?php echo $order['order_id']; ?>">Edit Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                            <label for="editOrderDate<?php echo $order['order_id']; ?>" class="form-label">Order Date</label>
                                            <input type="date" class="form-control" id="editOrderDate<?php echo $order['order_id']; ?>" name="order_date" value="<?php echo htmlspecialchars($order['order_date'] ?? ''); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editCustomerName<?php echo $order['order_id']; ?>" class="form-label">Customer</label>
                                            <input type="text" class="form-control" id="editCustomerName<?php echo $order['order_id']; ?>" name="customer_name" value="<?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname'] ?? ''); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editTotalAmount<?php echo $order['order_id']; ?>" class="form-label">Total Amount</label>
                                            <input type="number" step="0.01" class="form-control" id="editTotalAmount<?php echo $order['order_id']; ?>" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount'] ?? ''); ?>" required>
                                        </div>
                                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                        <input type="hidden" name="actionType" value="Update">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No orders found!</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
