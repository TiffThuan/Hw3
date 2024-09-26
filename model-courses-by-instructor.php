<?php
function selectCoursesByInstructor($iid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT od.order_id, o.customer_id, o.order_date, o.total_amount, o.status, od.quantity, od.price 
                                FROM orders o 
                                JOIN order_details od ON o.order_id = od.order_id 
                                WHERE o.customer_id = ?");
        $stmt->bind_param("i", $iid);
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
