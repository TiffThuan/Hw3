<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// Function to get all products
function selectProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT p.productid, p.product_name, p.product_description, p.price, 
                   od.order_id, od.quantity, od.price AS order_price, o.status 
            FROM products p
            LEFT JOIN order_details od ON p.productid = od.product_id
            LEFT JOIN orders o ON od.order_id = o.order_id
        ");
        
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        
        return $result;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}

// Function to add a new product
function addProduct($product_name, $product_description, $price) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $product_name, $product_description, $price);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        if ($conn) {
            $conn->close();
        }
        throw $e;
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
        if ($conn) {
            $conn->close();
        }
        throw $e;
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
        if ($conn) {
            $conn->close();
        }
        throw $e;
    }
}
?>
