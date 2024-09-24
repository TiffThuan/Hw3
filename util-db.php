<?php
function get_db_connection(){
    // Create connection
    $conn = new mysqli(' 129.15.65.230', 'mis4013db', 'Hippolove123#', 'mis-4013db');
    
    // Check connection
    if ($conn->connect_error) {
      return false;
    }
    return $conn;
}
?>
