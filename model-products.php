<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// Function to get all products
function selectProducts() {
    try {
        $conn = get_db_connection();
        // Fetch products with associated order details
        $stmt = $conn->prepare("
            SELECT p.productid, p.product_name, p.product_description, p.price, 
                   od.order_id, od.quantity, od.price AS order_price, o.status 
            FROM products p
            LEFT JOIN order_details od ON p.productid = od.product_id
            LEFT JOIN orders o ON od.order_id = o.order_id
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        
        return $result;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}
?>
