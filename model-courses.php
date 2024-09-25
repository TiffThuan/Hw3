

<?php
function selectCourses() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT order_id, customer_id, order_date, total_amount, status 
                                FROM orders");
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

