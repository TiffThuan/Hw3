<?php
function selectProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT productid, product_name, product_description, price
            FROM products
            ORDER BY product_name ASC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error fetching products: " . $e->getMessage());
        return null;
    } finally {
        $conn->close();
    }
}

function fetchNewArrivals() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT productid, product_name, product_description, price
            FROM products
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error fetching new arrivals: " . $e->getMessage());
        return null;
    } finally {
        $conn->close();
    }
}

function insertProduct($name, $description, $price) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, price, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssd", $name, $description, $price);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error inserting product: " . $e->getMessage());
        return false;
    } finally {
        $conn->close();
    }
}

function updateProduct($id, $name, $description, $price) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, price = ? WHERE productid = ?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error updating product: " . $e->getMessage());
        return false;
    } finally {
        $conn->close();
    }
}

function deleteProduct($id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM products WHERE productid = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error deleting product: " . $e->getMessage());
        return false;
    } finally {
        $conn->close();
    }
}
?>
