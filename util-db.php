<?php
function get_db_connection() {

    $conn = new mysqli('mis-4013db.mysql.database.azure.com', 'mis4013db', 'Hippolove123#', 'mycoffeeshop_database');
    
      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
}
