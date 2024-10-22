<?php
require_once('util-db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function selectReviews($review_id = null) {
    try {
        $conn = get_db_connection();
        if ($review_id !== null) {
            $stmt = $conn->prepare("SELECT * FROM reviews WHERE review_id = ?");
            $stmt->bind_param("i", $review_id);
        } else {
            $stmt = $conn->prepare("SELECT * FROM reviews");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; // Return the result set
    } catch (Exception $e) {
        throw $e;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

function insertReview($product_id, $customer_id, $rating, $review_text) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO reviews (product_id, customer_id, rating, review_text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $product_id, $customer_id, $rating, $review_text);
        
        $success = $stmt->execute();
        if (!$success) {
            error_log("SQL Error: " . $stmt->error); // Log SQL error
        }
        $stmt->close();
        return $success; // Return true if successful
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log exception message
        return false; // Return false on error
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

function fetchProducts() {
    try {
        $conn = get_db_connection(); // Ensure you have this function defined to connect to your DB
        $stmt = $conn->prepare("SELECT productid, product_name FROM products");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; // Return the result set
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log any errors
        return null; // Return null on error
    } finally {
        if ($conn) {
            $conn->close(); // Close the connection
        }
    }
}

// UPDATED: Including product_id in the review update
function updateReview($review_id, $product_id, $rating, $review_text) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE reviews SET product_id = ?, rating = ?, review_text = ? WHERE review_id = ?");
        $stmt->bind_param("iisi", $product_id, $rating, $review_text, $review_id); // Bind product_id
        $success = $stmt->execute();
        $stmt->close();
        return $success; // Return true if successful
    } catch (Exception $e) {
        return false; // Return false on error
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

function deleteReview($review_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
        $stmt->bind_param("i", $review_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success; // Return true if successful
    } catch (Exception $e) {
        return false; // Return false on error
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}
?>
