<?php
function get_db_connection() {
    // Create connection
    $conn = new mysqli('mis-4013db.mysql.database.azure.com', 'mis4013db', 'Hippolove123#', '4013 Azure (mycoffeeshop_database)');
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
