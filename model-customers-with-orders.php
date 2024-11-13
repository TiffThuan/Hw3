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
            SELECT o.order_id, o.order_date, o.total_amount, o.status
            FROM orders o
            WHERE o.customer_id = ?
        ");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
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


?>
