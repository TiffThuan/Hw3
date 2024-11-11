<?php
require_once('util-db.php');
require_once('model-orders.php'); // Ensure this file has the necessary SQL functions

$pageTitle = "Order Details";
include 'view-header.php';

// Check if order_id is received from POST
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

// Validate the order_id
if ($order_id) {
    // Fetch order details using the model function
    $orderDetails = selectOrderDetails($order_id);

    // Check if there are records
    if ($orderDetails && $orderDetails->num_rows > 0) {
        echo "<h1 class='text-center mt-5'>Order Details</h1>";
        echo "<div class='table-responsive mt-3'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead><tbody>";

        // Loop through the details and display them
        while ($detail = $orderDetails->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($detail['product_name']) . "</td>
                <td>" . htmlspecialchars($detail['quantity']) . "</td>
                <td>$" . htmlspecialchars(number_format($detail['price'], 2)) . "</td>
            </tr>";
        }

        echo "</tbody></table></div>";
    } else {
        // Display a message if no details are found
        echo "<div class='alert alert-warning mt-5'>No details found for this order.</div>";
    }
} else {
    // Display a message for invalid order_id
    echo "<div class='alert alert-danger mt-5'>Invalid Order ID. Please provide a valid Order ID.</div>";
}

include 'view-footer.php';
?>
