<?php
session_start();
include "DBConn.php";

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and user_id is set in the session
if (isset($_SESSION['user_id'])) {
    $user_ID = $_SESSION['user_id']; // Retrieve the user ID from the session

    // Check if prod_ID and quantity are set in the POST request
    if (isset($_POST['prod_ID']) && isset($_POST['quantity'])) {
        $prod_ID = $_POST['prod_ID'];
        $quantity = $_POST['quantity'];

        // Update the quantity of the product in the cart
        $sql = "UPDATE cart SET quantity = ? WHERE user_ID = ? AND prod_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $user_ID, $prod_ID);
        $stmt->execute();

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
} else {
    // If the user is not logged in, redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}
