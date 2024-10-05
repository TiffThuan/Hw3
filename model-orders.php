<?php

function selectOrders() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT o.order_id, o.order_date, c.firstname, c.lastname, o.total_amount 
                                FROM orders o 
                                JOIN customers c ON o.customer_id = c.customer_id");
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

function insertOrder($customer_id, $total_amount) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `mycoffeeshop_database`.`orders` (`customer_id`, `total_amount`) VALUES (?, ?);");
        $stmt->bind_param("id", $customer_id, $total_amount);
        $success = $stmt->execute();
    
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function updateOrder($order_id, $customer_id, $total_amount) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `mycoffeeshop_database`.`orders` SET customer_id = ?, total_amount = ? WHERE order_id = ?");
        $stmt->bind_param("idi", $customer_id, $total_amount, $order_id);   
        $success = $stmt->execute();
        
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function deleteOrder($order_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `mycoffeeshop_database`.`orders` WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);   
        $success = $stmt->execute();
    
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
?>
