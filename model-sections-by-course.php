<?php

function selectSectionsByCourse($cid) {
    $conn = null; // Initialize connection variable
    try {
        $conn = get_db_connection();
        
        // Use a proper JOIN clause to get relevant fields from order_details
        $stmt = $conn->prepare("
            SELECT o.order_id, o.customer_id, o.order_date, o.total_amount, o.status 
            FROM orders o 
            JOIN order_details od ON o.order_id = od.order_id 
            WHERE o.order_id = ?");
        
        $stmt->bind_param("i", $cid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result; // Return result without closing the connection yet
    } catch (Exception $e) {
        // Ensure connection is closed even if an exception occurs
        if ($conn) {
            $conn->close();
        }
        throw $e; // Re-throw the exception for handling higher up
    } finally {
        // Close the connection in the finally block to ensure it happens after the try/catch
        if ($conn) {
            $conn->close();
        }
    }
}
?>
