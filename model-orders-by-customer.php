<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function selectOrders() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT o.order_id, o.order_date, c.firstname, c.lastname, o.total_amount 
                                FROM orders o 
                                JOIN customers c ON o.customer_id = c.customer_id");
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Failed to fetch result: " . $stmt->error);
        }

        $stmt->close();
        
        return $result;
    } catch (Exception $e) {
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

<?php
function selectOrdersByCustomer($customer_id) {
    try {
        $conn = get_db_connection(); // Open database connection
        $stmt = $conn->prepare("SELECT o.order_id, o.order_date, o.total_amount, c.firstname, c.lastname 
                                FROM orders o 
                                JOIN customers c ON o.customer_id = c.customer_id 
                                WHERE o.customer_id = ?");
        $stmt->bind_param("i", $customer_id); // Bind the customer_id parameter
        $stmt->execute(); // Execute the query
        $result = $stmt->get_result(); // Get the result
        $conn->close(); // Close the connection
        return $result; // Return the result set
    } catch (Exception $e) {
        // Handle any exceptions
        if ($conn) {
            $conn->close(); // Ensure the connection is closed in case of error
        }
        throw $e;
    }
}
?>


?>
