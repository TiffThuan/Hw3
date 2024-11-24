<?php
require_once('util-db.php');

function ProductsWithReviews() {
    // Include database connection


    // SQL query to fetch products with their reviews
    $query = "
        SELECT 
            p.productid, 
            p.product_name, 
            p.product_description, 
            p.price, 
            r.review_id, 
            r.rating, 
            r.review_text 
        FROM 
            products p
        LEFT JOIN 
            reviews r ON p.productid = r.product_id
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check for query execution errors
    if (!$result) {
        die("Error fetching products with reviews: " . $conn->error);
    }

    return $result;
}
?>
