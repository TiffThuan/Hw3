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
    <div class="row mb-4">
        <div class="col text-center">
            <h1>Orders</h1>
        </div>
    </div>

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
                    <th>View Details</th>
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
                                <!-- Include the form to edit order (if necessary) -->
                                <?php include "view-orders-editform.php"; ?>
                                <!-- Delete Button -->
                                <form method="post" action="" style="display:inline;">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <input type="hidden" name="actionType" value="Delete">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>

                            <td>
                                <!-- View Details Button using POST -->
                                <form method="POST" action="order-details.php">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <button type="submit" class="btn btn-info">View Details</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No orders found.</td></tr>"; // Adjust the colspan accordingly
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="path/to/bootstrap.bundle.min.js"></script> <!-- Ensure Bootstrap JS is linked -->
</body>
</html>
