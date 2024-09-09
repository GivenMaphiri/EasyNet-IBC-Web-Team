<?php
session_start();
include "DBConn.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Set a session variable or redirect with a query parameter
    $_SESSION['login_required'] = true;
    header("Location: login.php"); // Redirect to the product page or wherever you want
    exit();
}

if (isset($_POST['prod_id']) && isset($_SESSION['user_ID'])) {
    $prod_id = $_POST['prod_id'];
    $user_id = $_SESSION['user_ID'];

    // Add product to favorites
    $sql = "INSERT INTO favorites (user_ID, prod_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $prod_id);

    $stmt->execute();
    $stmt->close();
}
$conn->close();
