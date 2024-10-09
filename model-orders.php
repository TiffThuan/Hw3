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

function insertOrder($order_date, $cFName, $cLName, $total_amount) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `mycoffeeshop_database`.`orders` (`order_date`, `firstname`, `lastname`, `total_amount`) VALUES (?, ?,?, ?);");
        
        // Bind the parameters correctly for date (string), customer_id (integer), total_amount (decimal)
        $stmt->bind_param("sssd", $order_date, $cFName,$cLName, $total_amount);
        $success = $stmt->execute();
    
        $stmt->close();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}

function updateOrder($order_id, $order_date, $cFName,$cLName, $total_amount) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `mycoffeeshop_database`.`orders` 
                                SET order_date = ?, firstname = ?, lastname=?, total_amount = ? 
                                WHERE order_id = ?");
        
        // Bind the parameters correctly for date, customer_id, total_amount, and order_id
        $stmt->bind_param("isssd", $order_id, $order_date,$cFName,$cLName, $total_amount);   
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}

function deleteOrder($order_id) {
    try {
        
        deleteOrderDetails($order_id); // First, delete related order details
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `mycoffeeshop_database`.`orders` WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);   
        $success = $stmt->execute();
    
        $stmt->close();
        $conn->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}

function deleteOrderDetails($order_id) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("DELETE FROM order_details WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>


