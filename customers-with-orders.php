<?php
require 'db_connection.php'; // Adjust this to your actual connection script

$conn = get_db_connection();  // Assuming you have a function for database connection

// Fetch customers with orders
$customer_orders_stmt = $conn->prepare("
    SELECT c.customer_id, c.firstname, c.lastname, COUNT(o.order_id) as orders_count
    FROM customers c
    JOIN orders o ON c.customer_id = o.customer_id
    GROUP BY c.customer_id
    HAVING COUNT(o.order_id) > 0
");
$customer_orders_stmt->execute();
$customer_orders_result = $customer_orders_stmt->get_result();

if ($customer_orders_result->num_rows > 0) {
    while ($customer = $customer_orders_result->fetch_assoc()) {
        echo "<h3>Customer: " . $customer['firstname'] . " " . $customer['lastname'] . "</h3>";
        echo "Customer ID: " . $customer['customer_id'] . "<br>";
        echo "Orders Placed: " . $customer['orders_count'] . "<br>";
        echo "<a href='orders-by-customer.php?id=" . $customer['customer_id'] . "'>View Orders</a><br><hr>";
    }
} else {
    echo "No customers found with orders.";
}

$conn->close();
?>
