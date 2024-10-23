<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Ensure Bootstrap CSS is linked -->
    <link rel="stylesheet" href="path/to/your-custom-styles.css"> <!-- Optional custom styles -->
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Orders</h1>
    
    <!-- Include the New Order Modal here -->
    <?php include 'view-orders-newform.php'; ?>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
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
                            <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($order['order_date']))); ?></td>
                            <td><?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></td>
                            <td><?php echo htmlspecialchars('$' . number_format($order['total_amount'], 2)); ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Order Actions">
                                    <!-- Include the form to edit order (if necessary) -->
                                    <?php include "view-orders-editform.php"; ?>

                                    <!-- Delete Button -->
                                    <form method="post" action="" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                        <input type="hidden" name="actionType" value="Delete">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</button>
                                    </form>

                                    <!-- View Details Button using POST -->
                                    <form method="POST" action="order-details.php" style="display:inline;">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                        <button type="submit" class="btn btn-info">View Details</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No orders found.</td></tr>"; // Centered message for no orders
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="path/to/bootstrap.bundle.min.js"></script> <!-- Ensure Bootstrap JS is linked -->
</body>
</html>
