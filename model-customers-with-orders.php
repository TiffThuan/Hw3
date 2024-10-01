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
        
        // Close the connection
        $conn->close();
        
        return $result;
    } catch (Exception $e) {
        // Close the connection and handle any errors
        $conn->close();
        throw $e;
    }
}

function selectOrdersByCustomer($customer_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT 
                o.order_id, 
                o.customer_id, 
                o.order_date, 
                o.total_amount, 
                o.status 
            FROM orders o
            WHERE o.customer_id = ?
        ");
        $stmt->bind_param("i", $customer_id); // Corrected the bind_param syntax
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}


?>
