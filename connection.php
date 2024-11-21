<?php

    include "credentials.php";
    
    // Initialize the connection
    $connection = new mysqli('localhost', $user, $password, $db);
    
    
    // Prepare and execute the SQL query
    $AllRecords = $connection->prepare("SELECT * FROM SCP");
    $AllRecords->execute();
    $result = $AllRecords->get_result();
    
?>