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
        
        // Prepare variables
        $customer_id_var = $customer_id ?: null; // Allow null for customer_id
        $stmt->bind_param("iiis", $product_id, $customer_id_var, $rating, $review_text);

        $success = $stmt->execute();
        if (!$success) {
            error_log("SQL Error: " . $stmt->error); // Log the SQL error
        }
        $stmt->close();
        return $success; // Return true if successful
    } catch (Exception $e) {
        error_log("Exception: " . $e->getMessage()); // Log the exception message
        return false; // Return false on error
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}


function fetchReviewsByProduct($product_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
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


function updateReview($review_id, $rating, $review_text) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE reviews SET rating = ?, review_text = ? WHERE review_id = ?");
        $stmt->bind_param("ssi", $rating, $review_text, $review_id);
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
