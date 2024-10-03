<?php

function selectProducts($product_id = null) {
    try {
        $conn = get_db_connection();
        
        if ($product_id) {
            // Fetch order details for a specific product
            $stmt = $conn->prepare("SELECT od.order_id, o.order_date, od.quantity, od.price 
                                    FROM order_details od
                                    JOIN orders o ON od.order_id = o.order_id
                                    WHERE od.product_id = ?");
            $stmt->bind_param("i", $product_id);
        } else {
            // Fetch all products if no product_id is provided
            $stmt = $conn->prepare("SELECT productid, product_name, product_description, price FROM products");
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();  // Close the statement
        $conn->close();  // Close the connection

        return $result;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();  // Ensure the connection is closed in case of error
        }
        throw $e;
    }
}

function selectOrderDetails($order_id) {
    $conn = null;
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT od.order_id, p.product_name, od.quantity, od.price 
                                FROM order_details od
                                JOIN products p ON od.product_id = p.productid
                                WHERE od.order_id = ?");
        
        // Bind the order_id to the query
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    } catch (Exception $e) {
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

?>
