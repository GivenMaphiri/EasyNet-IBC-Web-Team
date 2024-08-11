<?php
session_start();
include "DBConn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page or show an appropriate message
    header("Location: login.php");
    exit();
}

if (isset($_POST['prod_ID'])) {
    $prod_ID = $_POST['prod_ID'];

    // Retrieve the user ID from the session
    $user_ID = $_SESSION['user_id'];

    $sql = "DELETE FROM cart WHERE user_ID = ? AND prod_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_ID, $prod_ID);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
