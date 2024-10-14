<?php
require_once('util-db.php');

function ProductsWithReviews() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("
            SELECT p.productid, p.product_name, p.product_description, p.price, 
                   r.review_id, r.rating, r.review_text
            FROM products p
            LEFT JOIN reviews r ON p.productid = r.product_id
        ");
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
?>
