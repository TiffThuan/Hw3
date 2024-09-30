<?php
function get_db_connection() {
    // Create connection
    $conn = new mysqli('mis-4013db.mysql.database.azure.com', 'mis4013db', 'Hippolove123#', 'mycoffeeshop_database');
    
    // Check if connection was successful
    if ($conn->connect_error) {
        // Use a more detailed error message and log it
        error_log("Database connection failed: " . $conn->connect_error);
        throw new Exception("Database connection failed. Please try again later.");
    }
    
    // Set character encoding to UTF-8 to avoid character issues
    if (!$conn->set_charset("utf8")) {
        error_log("Error setting charset: " . $conn->error);
        throw new Exception("Error setting charset.");
    }

    return $conn;
}
?>
