<?php
function selectProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT productid, product_name, price, stock FROM products");
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
