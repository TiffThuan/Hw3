<?php
function selectCustomers() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT customer_id, firstname, lastname, email, phone FROM customers");
    if (!$stmt->execute()) {
        error_log("Database error: " . $stmt->error);
        return false;
    }
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return $result;
}


function insertCustomers($cFName, $cLName, $cEmail, $cPhone) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cFName, $cLName, $cEmail, $cPhone);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

function updateCustomers($cFName, $cLName, $cEmail, $cPhone, $cid) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("UPDATE customers SET firstname = ?, lastname = ?, email = ?, phone = ? WHERE customer_id = ?");
    $stmt->bind_param("ssssi", $cFName, $cLName, $cEmail, $cPhone, $cid);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

function deleteCustomers($cid) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
    $stmt->bind_param("i", $cid);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

function getCustomerOrderDetails() {
    $conn = get_db_connection();
    try {
        $stmt = $conn->prepare("
            SELECT 
                c.customer_id, 
                c.firstname, 
                c.lastname, 
                c.email, 
                c.phone, 
                o.order_date, 
                o.total_amount, 
                od.quantity, 
                p.product_name
            FROM customers c
            LEFT JOIN orders o ON c.customer_id = o.customer_id
            LEFT JOIN order_details od ON o.order_id = od.order_id
            LEFT JOIN products p ON od.product_id = p.productid
            ORDER BY c.customer_id, o.order_date DESC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error fetching customer order details: " . $e->getMessage());
        return null;
    } finally {
        $conn->close();
    }
}



function getNewCustomersOverTime() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("
        SELECT DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS new_customers
        FROM customers
        GROUP BY DATE_FORMAT(created_at, '%Y-%m')
        ORDER BY MIN(created_at)
    ");
    if (!$stmt->execute()) {
        error_log("SQL Error: " . $stmt->error);
        return [];
    }
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $data;
}

?>
