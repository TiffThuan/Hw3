

<?php
function selectDetailsByOrder($order_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT od.order_id, p.product_name, od.quantity, od.price 
            FROM order_details od
            JOIN products p ON od.product_id = p.productid
            WHERE od.order_id = ?;
        ");
        $stmt->bind_param("i", $order_id); // Bind the order_id
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

