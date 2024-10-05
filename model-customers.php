<?php
function selectCustomers() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT customer_id, firstname, lastname, email, phone FROM customers");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function insertCustomers($cFName, $cLName, $cEmail, $cPhone) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `mycoffeeshop_database`.`customers`
                                (`firstname`,
                                `lastname`,
                                `email`,
                                `phone`)
                                VALUES
                                (?,?,?,?);");
        $stmt->bind_param("ssss", $cFName, $cLName, $cEmail, $cPhone);   //ss: number of string variables
        $success = $stmt->execute();
    
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function updateCustomers($cFName, $cLName, $cEmail, $cPhone,$cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `mycoffeeshop_database`.`customers` SET
                                (`firstname` = ?,
                                `lastname`= ?,
                                `email`=?,
                                `phone`=?) WHERE customer_id = ?");
        $stmt->bind_param("ssssi", $cFName, $cLName, $cEmail, $cPhone,$cid);   
        $success = $stmt->execute();
    
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}

function deleteCustomers($cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM `mycoffeeshop_database`.`customers` WHERE customer_id = ?");
        $stmt->bind_param("i", $cid);   // i: one interger value
        $success = $stmt->execute();
    
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>

