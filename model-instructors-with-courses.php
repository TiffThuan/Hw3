
<?php

function selectInstructors() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare(select customer_id, firstname, lastname, address from customers);
    
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}



function selectCoursesByInstructor($iid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("select o.order_id, customer_id, order_date, total_amount, status from orders o join order_details od on o.order_id = od.order_id where o.customer_id=? ");
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
