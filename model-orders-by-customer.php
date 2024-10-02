<?php

function selectOrders() {
    $conn = null;
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT o.order_id, o.order_date, c.firstname, c.lastname, o.total_amount 
                                FROM orders o 
                                JOIN customers c ON o.customer_id = c.customer_id");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Failed to fetch result: " . $stmt->error);
        }

        $stmt->close();
        
        return $result;
    } catch (Exception $e) {
        // Handle the error (e.g., log it and display a user-friendly message)
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}


function selectOrdersByCustomer($customer_id) {
    $conn = null;
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT order_id, order_date, total_amount 
                                FROM orders 
                                WHERE customer_id = ?");
        
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Failed to fetch result: " . $stmt->error);
        }

        $stmt->close();

        return $result;
    } catch (Exception $e) {
        // Handle the error (e.g., log it and display a user-friendly message)
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}


?>
