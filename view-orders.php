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

    <div class="list-group">
        <?php
        if ($orders && $orders->num_rows > 0) {
            while ($order = $orders->fetch_assoc()) {
        ?>
                <div class="list-group-item">
                    <h5 class="mb-1">Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h5>
                    <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                    <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></p>
                    <p><strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?></p>

                    <div class="d-flex justify-content-between">
                        <div>
                            
                            <!-- Include the New Order Modal here -->
                            <?php include 'view-orders-newform.php'; ?>

                            <!-- Include the form to edit order (if necessary) -->
                            <?php include "view-orders-editform.php"; ?>
                        </div>
                        <div>
                            <!-- Delete Button -->
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <input type="hidden" name="actionType" value="Delete">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div>
                            <!-- View Details Button using POST -->
                            <form method="POST" action="order-details.php" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" class="btn btn-info btn-sm">View Details</button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='list-group-item text-center'>No orders found.</div>"; // Adjust the message if needed
        }
        ?>
    </div>
</div>

<script src="path/to/bootstrap.bundle.min.js"></script> <!-- Ensure Bootstrap JS is linked -->
</body>
</html>
