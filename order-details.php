<?php
require_once('util-db.php');
require_once('model-orders.php'); // Ensure this file has the necessary SQL functions

$pageTitle = "Order Details";
include 'view-header.php';

$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

if ($order_id) {
    $orderDetails = selectOrderDetails($order_id); // Fetch order details using SQL query

    if ($orderDetails && $orderDetails->num_rows > 0) {
        echo "<h1>Order Details</h1>";
        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead><tbody>";

        while ($detail = $orderDetails->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($detail['product_name']) . "</td>
                <td>" . htmlspecialchars($detail['quantity']) . "</td>
                <td>$" . htmlspecialchars(number_format($detail['price'], 2)) . "</td>
            </tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<p>No details found for this order.</p>";
    }
} else {
    echo "<p>Invalid Order ID. Please provide a valid Order ID.</p>";
}

include 'view-footer.php';
?>
