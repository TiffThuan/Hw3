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
                <th>Email</th> <!-- Add the email column -->
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
                        <td><?php echo htmlspecialchars($order['email']); ?></td> <!-- Display customer email -->
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td>
                        <?php
                        // Include the form to edit order (if necessary)
                        include "view-orders-editform.php";
                        ?>
                        </td>
                        <td>
                            <!-- Delete Button -->
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <input type="hidden" name="actionType" value="Delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </td>
                        <td>
                            <!-- View Order Details Button -->
                            <a href="order-details.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary">View Details</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='8'>No orders found.</td></tr>"; // Adjust the colspan to account for the extra column
            }
            ?>
        </tbody>
    </table>
</div>
