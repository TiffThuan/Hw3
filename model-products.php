<?php
function selectProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT productid, product_name, product_description, price FROM products");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function selectOrders() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT o.order_id, c.firstname AS customer_name, o.order_date, o.total_amount, o.status 
                                FROM orders o
                                JOIN customers c ON o.customer_id = c.customer_id
                                WHERE o.customer_id =?");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close(); // Close the connection after the query
        
        return $result;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}
?>
