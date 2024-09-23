
<?php

function selectCourses() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare(select 'order_id', 'customer_id', 'order_date',' total_amount', 'status' from 'orders'
);
    
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
