<?php

function selectCustomers() {
    try {
        // Get the database connection
        $conn = get_db_connection();
        
        // Select customer details
        $stmt = $conn->prepare("SELECT customer_id, firstname, lastname, address FROM customers");
        $stmt->execute();
        
        // Get the result set
        $result = $stmt->get_result();
        
        // Close the statement (optional good practice)
        $stmt->close();
        
        // Return the result set
        return $result;
    } catch (Exception $e) {
        // Handle the exception
        throw $e;
    } finally {
        // Ensure connection is closed, whether an exception occurs or not
        if ($conn) {
            $conn->close();
        }
    }
}

function selectCustomersWithOrders($customer_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT o.order_id, c.firstname AS customer_name, o.order_date, o.total_amount, o.status 
            FROM orders o
            JOIN customers c ON o.customer_id = c.customer_id
            WHERE o.customer_id = ?
        ");
        
        // Bind the customer_id parameter
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        
        // Get the result set
        $result = $stmt->get_result();
        
        // Close the statement (optional)
        $stmt->close();
        
        // Return the result set
        return $result;
    } catch (Exception $e) {
        // Handle the exception
        throw $e;
    } finally {
        // Ensure connection is closed
        if ($conn) {
            $conn->close();
        }
    }
}

?>
