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
                MAX(o.order_date) AS order_date, 
                GROUP_CONCAT(DISTINCT p.product_name SEPARATOR ', ') AS product_names,
                SUM(od.quantity) AS total_quantity,
                SUM(od.price * od.quantity) AS total_amount
            FROM customers c
            LEFT JOIN orders o ON c.customer_id = o.customer_id
            LEFT JOIN order_details od ON o.order_id = od.order_id
            LEFT JOIN products p ON od.product_id = p.productid
            GROUP BY c.customer_id, c.firstname, c.lastname, c.email, c.phone
            ORDER BY MAX(o.order_date) DESC
        ");
        if (!$stmt->execute()) {
            error_log("Error executing query: " . $stmt->error);
            return null;
        }
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error in getCustomerOrderDetails: " . $e->getMessage());
        return null;
    } finally {
        $conn->close();
    }
}

function getNewCustomersOverTime() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("
        SELECT 
            DATE_FORMAT(created_at, '%b %Y') AS month, 
            COUNT(*) AS new_customers
        FROM customers
        GROUP BY DATE_FORMAT(created_at, '%b %Y')
        ORDER BY MIN(created_at)
    ");
    $stmt->execute();
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
