<?php

session_start();
include "DBConn.php";


//retrieve form data 
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Prepare and execute the SQL statement
    $sql = "INSERT INTO messages (name, email, message_content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    //feedback to user
    echo "Message sent successfully...";

    
}

?>