<?php 
include "config.php";
$db = null;

// connect to server
$conn = mysqli_connect($db_host, $db_user, $db_password) or die("Connect failed: %s\n". $conn -> error);


// connect to database
if($conn){

    if (!mysqli_select_db($conn, $db_name)) {
        echo("creating database!<br>");

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
        if (mysqli_query($conn, $sql)) {
            echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . mysqli_error($conn);
        }
    }

    // Connect to database
    $db = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if($db === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
}

// Print host information
// echo "Connect Successfully. Host info: " . mysqli_get_host_info($db);
?>
