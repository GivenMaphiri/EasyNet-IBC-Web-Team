<?php
session_start();
include "DBConn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['prod_ID']) && isset($_POST['quantity'])) {
    $prod_ID = $_POST['prod_ID'];
    $quantity = $_POST['quantity'];

    $user_ID = 1; // Replace with dynamic user ID when needed

    $sql = "UPDATE cart SET quantity = ? WHERE user_ID = ? AND prod_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $user_ID, $prod_ID);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
