<?php

function selectOrders() {
    $conn = null;
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT o.order_id, o.order_date, o.total_amount, o.payment_method, o.status,
                   c.customer_id, c.firstname, c.lastname 
            FROM orders o 
            JOIN customers c ON o.customer_id = c.customer_id
        ");
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

function insertOrder($order_date, $cFName, $cLName, $total_amount, $payment_method, $status) {
    $conn = get_db_connection();
    try {
        // Check if customer exists
        $stmt = $conn->prepare("SELECT customer_id FROM customers WHERE firstname = ? AND lastname = ?");
        $stmt->bind_param("ss", $cFName, $cLName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Customer exists
            $customer = $result->fetch_assoc();
            $customer_id = $customer['customer_id'];
        } else {
            // Insert new customer
            $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname) VALUES (?, ?)");
            $stmt->bind_param("ss", $cFName, $cLName);
            $stmt->execute();
            $customer_id = $stmt->insert_id;
        }

        // Insert order
        $stmt = $conn->prepare("
            INSERT INTO orders (order_date, customer_id, total_amount, payment_method, status) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("sidss", $order_date, $customer_id, $total_amount, $payment_method, $status);
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

function updateOrder($order_id, $order_date, $cFName, $cLName, $total_amount, $payment_method, $status) {
    try {
        $conn = get_db_connection();

        // Check if the customer exists
        $stmt = $conn->prepare("SELECT customer_id FROM customers WHERE firstname = ? AND lastname = ?");
        $stmt->bind_param("ss", $cFName, $cLName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
            $customer_id = $customer['customer_id'];
        } else {
            // Insert new customer
            $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname) VALUES (?, ?)");
            $stmt->bind_param("ss", $cFName, $cLName);
            $stmt->execute();
            $customer_id = $stmt->insert_id;
        }

        // Update the order
        $stmt = $conn->prepare("
            UPDATE orders
            SET order_date = ?, customer_id = ?, total_amount = ?, payment_method = ?, status = ?
            WHERE order_id = ?
        ");
        $stmt->bind_param("sidssi", $order_date, $customer_id, $total_amount, $payment_method, $status, $order_id);
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

function calculateMenuPercentages() {
    $conn = null;
    try {
        $conn = get_db_connection();

        // Query to calculate the total quantity per product
        $query = "
            SELECT p.product_name, SUM(od.quantity) AS total_quantity
            FROM order_details od
            JOIN products p ON od.product_id = p.productid
            GROUP BY p.product_name
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Fetch the total quantity for all products
        $totalQuery = "SELECT SUM(quantity) AS total_quantity FROM order_details";
        $totalResult = $conn->query($totalQuery);
        $totalQuantity = $totalResult->fetch_assoc()['total_quantity'];

        // Calculate percentages for each product
        $percentages = [];
        while ($row = $result->fetch_assoc()) {
            $percentages[] = [
                'product_name' => $row['product_name'],
                'percentage' => ($row['total_quantity'] / $totalQuantity) * 100
            ];
        }

        return $percentages;
    } catch (Exception $e) {
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

?>


