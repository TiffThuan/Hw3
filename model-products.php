<?php

// Function to get all products
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
        error_log("Error in selectProducts: " . $e->getMessage());
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

// Function to fetch new arrivals (recently added products)
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
        error_log("Error in fetchNewArrivals: " . $e->getMessage());
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

// Function to insert a new product
function insertProduct($product_name, $product_description, $price) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, price, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssd", $product_name, $product_description, $price);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error in insertProduct: " . $e->getMessage());
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

// Function to update an existing product
function updateProduct($productid, $product_name, $product_description, $price) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, price = ? WHERE productid = ?");
        $stmt->bind_param("ssdi", $product_name, $product_description, $price, $productid);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error in updateProduct: " . $e->getMessage());
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

// Function to delete a product
function deleteProduct($productid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM products WHERE productid = ?");
        $stmt->bind_param("i", $productid);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error in deleteProduct: " . $e->getMessage());
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}
?>
