<?php 
    $localhost = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'foodie';
    
    $conn = mysqli_connect($localhost, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    else {
        // echo "Connected successfully";
    }
    
?>
        