<?php
// Check if the 'id' parameter is set and is numeric
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid customer ID provided.";
    exit();
}

$customer_id = intval($_GET['id']);

// Database connection
require 'db_connection.php'; // Adjust this to your actual connection script

$conn = get_db_connection();  // Assuming you have a function for database connection

// Fetch customer information to verify the customer exists
$customer_stmt = $conn->prepare("SELECT firstname, lastname FROM customers WHERE customer_id = ?");
$customer_stmt->bind_param("i", $customer_id);
$customer_stmt->execute();
$customer_result = $customer_stmt->get_result();

if ($customer_result->num_rows == 0) {
    echo "No such customer found.";
    exit();
}

$customer_data = $customer_result->fetch_assoc();
echo "<h2>Orders for " . $customer_data['firstname'] . " " . $customer_data['lastname'] . "</h2>";

// Fetch customer orders
$order_stmt = $conn->prepare("
    SELECT o.order_id, o.order_date, o.total_amount, o.status
    FROM orders o
    WHERE o.customer_id = ?
");
$order_stmt->bind_param("i", $customer_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows > 0) {
    while ($order = $order_result->fetch_assoc()) {
        echo "Order ID: " . $order['order_id'] . "<br>";
        echo "Order Date: " . $order['order_date'] . "<br>";
        echo "Total Amount: $" . $order['total_amount'] . "<br>";
        echo "Status: " . $order['status'] . "<br><hr>";
    }
} else {
    echo "No orders found for this customer.";
}

$conn->close();
?>
