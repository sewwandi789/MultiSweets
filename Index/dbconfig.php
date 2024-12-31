<?php
    $host = "localhost"; // Host name
    $username = "root"; // Database username
    $password = ""; // Database password
    $database = "multisweets"; // Database name

// Create connection
    $conn = new mysqli($host, $username, $password, $database);
    
// Check connection
    if ($conn->connect_error) {
        die("Database Connection Failed: " . $conn->connect_error . PHP_EOL);
    } else {
        //echo "Database Connected Successfully" . PHP_EOL;
    }
?>
