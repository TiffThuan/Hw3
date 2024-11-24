<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Order Details</h1>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($orderDetails && $orderDetails->num_rows > 0) {
                    while ($orderDetail = $orderDetails->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($orderDetail['order_id']) . "</td>
                            <td>" . htmlspecialchars($orderDetail['product_name']) . "</td>
                            <td>" . htmlspecialchars($orderDetail['quantity']) . "</td>
                            <td>$" . htmlspecialchars(number_format($orderDetail['price'], 2)) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No order details found for Order ID: " . htmlspecialchars($order_id) . ".</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
