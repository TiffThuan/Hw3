<?php
function get_db_connection(){
    // Create connection
    $conn = new mysqli('mis-4013db.mysql.database.azure.com', 'mis4013db', 'Hippolove123#', 'mis-4013db');
    
    // Check connection
    if ($conn->connect_error) {
      return false;
    }
    return $conn;
}
?>
