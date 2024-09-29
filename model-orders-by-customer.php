<?php
    function selectOrdersByCustomer($customer_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT 
                o.order_id, 
                o.customer_id, 
                o.order_date, 
                o.total_amount, 
                o.status, 
                od.quantity, 
                od.price 
            FROM orders o
            JOIN order_details od ON o.order_id = od.order_id 
            WHERE o.customer_id = ?
        ");
        
        if ($stmt === false) {
            throw new Exception("Failed to prepare SQL statement: " . $conn->error);
        }
        $stmt->bind_param("i", $customer_id); // Make sure customer_id is an integer
        $stmt->execute();
    
        $result = $stmt->get_result();
        $stmt->close(); // Close the statement
        $conn->close(); // Close the connection
        return $result;
    } catch (Exception $e) {
        // Ensure the connection is properly closed in case of an error
        if (isset($conn)) {
            $conn->close();
        }
        throw $e;
    }
}
?>
