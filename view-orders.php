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

    <!-- Include the New Order Modal -->
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
                        
                        <!-- Actions - Including form for POST -->
                        <td>
                            <form method="POST" action="order-details.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" class="btn btn-info">View Details</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Include the Edit Modal for each order -->
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
