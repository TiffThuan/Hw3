

<?php
function selectCustomers() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT customer_id, firstname, lastname, address FROM customers");
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
