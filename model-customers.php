<?php
function selectCustomers() {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT customer_id, firstname, lastname, email, phone FROM customers");
    $stmt->execute();
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
?>
