<?php
require_once('util-db.php');
require_once('model-orders.php'); 

$pageTitle = "Order Details";
include 'view-header.php';

// Debug $_POST
if (empty($_POST)) {
    echo "<div class='alert alert-warning'>No data received. Please use the 'View Details' button.</div>";
    include 'view-footer.php';
    exit;
}

// Fetch order_id from POST
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;

if ($order_id) {
    $orderDetails = selectOrderDetails($order_id); // Fetch details from the database

    if ($orderDetails && $orderDetails->num_rows > 0) {
        echo "<h1 class='text-center mt-5'>Order Details</h1>";
        echo "<div class='table-responsive mt-3'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead><tbody>";

        while ($detail = $orderDetails->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($detail['product_name']) . "</td>
                <td>" . htmlspecialchars($detail['quantity']) . "</td>
                <td>$" . htmlspecialchars(number_format($detail['price'], 2)) . "</td>
            </tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<div class='alert alert-warning'>No details found for Order ID: $order_id</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Invalid Order ID. Please provide a valid Order ID.</div>";
}

include 'view-footer.php';
?>
