<?php

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    session_start(); // Start the session
    include "DBConn.php"; // Include your database connection

    // Get the message ID from the POST request
    $messageId = $_POST['messageId'];

    // Delete the message from the database
    $sql = "DELETE FROM message WHERE message_id = $messageId";
    if ($conn->query($sql) === TRUE) {
        header("Location: messages.php");
      echo "Message deleted successfully.";
    } else {
      echo "Error deleting message: " . $conn->error;
    }
  ?>