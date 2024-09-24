
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
?>
