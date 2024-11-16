<?php
require_once('util-db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Fetch all or a specific review.
 */
function selectReviews($review_id = null) {
    try {
        $conn = get_db_connection();
        if ($review_id !== null) {
            $stmt = $conn->prepare("SELECT r.*, p.product_name, c.firstname, c.lastname 
                                    FROM reviews r
                                    JOIN products p ON r.product_id = p.productid
                                    JOIN customers c ON r.customer_id = c.customer_id
                                    WHERE review_id = ?");
            $stmt->bind_param("i", $review_id);
        } else {
            $stmt = $conn->prepare("SELECT r.*, p.product_name, c.firstname, c.lastname 
                                    FROM reviews r
                                    JOIN products p ON r.product_id = p.productid
                                    JOIN customers c ON r.customer_id = c.customer_id");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error fetching reviews: " . $e->getMessage());
        return null;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

/**
 * Insert a new review.
 */
function insertReview($product_id, $customer_id, $rating, $review_text) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO reviews (product_id, customer_id, rating, review_text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $product_id, $customer_id, $rating, $review_text);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error inserting review: " . $e->getMessage());
        return false;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

/**
 * Fetch all products.
 */
function fetchProducts() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT productid, product_name FROM products");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error fetching products: " . $e->getMessage());
        return null;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

/**
 * Update an existing review.
 */
function updateReview($review_id, $product_id, $rating, $review_text) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE reviews SET product_id = ?, rating = ?, review_text = ? WHERE review_id = ?");
        $stmt->bind_param("iisi", $product_id, $rating, $review_text, $review_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error updating review: " . $e->getMessage());
        return false;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

/**
 * Delete a review by ID.
 */
function deleteReview($review_id) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
        $stmt->bind_param("i", $review_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    } catch (Exception $e) {
        error_log("Error deleting review: " . $e->getMessage());
        return false;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}

/**
 * Fetch all reviews with their product and customer details.
 */
function fetchReviewsWithDetails() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT r.review_id, r.rating, r.review_text, 
                                       p.product_name, 
                                       c.firstname AS customer_firstname, c.lastname AS customer_lastname
                                FROM reviews r
                                JOIN products p ON r.product_id = p.productid
                                JOIN customers c ON r.customer_id = c.customer_id
                                ORDER BY r.review_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    } catch (Exception $e) {
        error_log("Error fetching detailed reviews: " . $e->getMessage());
        return null;
    } finally {
        if ($conn) {
            $conn->close();
        }
    }
}
?>
