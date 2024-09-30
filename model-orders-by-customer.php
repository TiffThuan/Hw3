<?php
function selectOrdersByCustomer($customer_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT 
                o.order_id, 
                o.total_amount, 
                o.status, 
                od.quantity, 
                od.price 
            FROM orders o
            JOIN order_details od ON o.order_id = od.order_id 
            WHERE o.customer_id = ?
        ");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        if (isset($conn)) {
            $conn->close();
        }
        throw $e;
    }
}
?>
