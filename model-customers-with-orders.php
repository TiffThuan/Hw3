<?php
function selectCustomersWithOrders() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT c.customer_id, c.firstname, c.lastname, c.address 
            FROM customers c
            JOIN orders o ON c.customer_id = o.customer_id
            GROUP BY c.customer_id
        ");
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
