<?php
session_start();
include "DBConn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['prod_ID'])) {
    $prod_ID = $_POST['prod_ID'];

    $user_ID = 1; // Replace with dynamic user ID when needed

    $sql = "DELETE FROM cart WHERE user_ID = ? AND prod_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_ID, $prod_ID);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
