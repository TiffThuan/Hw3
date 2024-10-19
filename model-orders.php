<?php

function selectOrders() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT o.order_id, o.order_date, c.firstname, c.lastname, c.email, o.total_amount 
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

function insertOrder($order_date, $cFName, $cLName, $email, $total_amount) {
    try {
        $conn = get_db_connection();
        
        // Check if customer already exists based on name and email
        $stmt = $conn->prepare("SELECT customer_id FROM customers WHERE firstname = ? AND lastname = ? AND email = ?");
        $stmt->bind_param("sss", $cFName, $cLName, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Customer exists, retrieve their customer_id
            $customer = $result->fetch_assoc();
            $customer_id = $customer['customer_id'];
        } else {
            // Insert new customer with firstname, lastname, and email
            $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $cFName, $cLName, $email);
            $stmt->execute();
            $customer_id = $stmt->insert_id;
        }

        // Now insert the order with customer_id
        $stmt = $conn->prepare("INSERT INTO orders (order_date, customer_id, total_amount) VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $order_date, $customer_id, $total_amount);
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


function updateOrder($order_id, $order_date, $cFName, $cLName, $email, $total_amount) {
    try {
        $conn = get_db_connection();
        
        // Check if customer already exists based on name and email
        $stmt = $conn->prepare("SELECT customer_id FROM customers WHERE firstname = ? AND lastname = ? AND email = ?");
        $stmt->bind_param("sss", $cFName, $cLName, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Customer exists, retrieve their customer_id
            $customer = $result->fetch_assoc();
            $customer_id = $customer['customer_id'];
        } else {
            // If the customer does not exist, insert new customer with firstname, lastname, and email
            $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $cFName, $cLName, $email);
            $stmt->execute();
            $customer_id = $stmt->insert_id; // Get the new customer's ID
        }

        // Now update the order with the new customer_id
        // Note: Here, we're assuming customer_id is an integer (int)
        $stmt = $conn->prepare("UPDATE orders SET order_date = ?, customer_id = ?, total_amount = ? WHERE order_id = ?");
        $stmt->bind_param("sidi", $order_date, $customer_id, $total_amount, $order_id);   
        
        // Execute and check for success
        $success = $stmt->execute();
        
        // Close statement and connection
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


