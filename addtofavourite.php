<?php
session_start();
include "DBConn.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Set a session variable or redirect with a query parameter
    $_SESSION['login_required'] = true;
    header("Location: products2.php"); // Redirect to the product page or wherever you want
    exit();
}

// Rest of your add to cart code...
if (isset($_POST['add_to_favourite'])) {
    $prod_ID = $_POST['prod_ID'];
    $prod_name = $_POST['prod_name'];
    $prod_price = $_POST['prod_price'];
    $prod_image = $_POST['prod_image'];

    $user_ID = $_SESSION['user_id']; // Retrieve the user ID from the session

    // Check if the product is already in the cart for this user
    $sql = "SELECT * FROM favourite WHERE user_ID = ? AND prod_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_ID, $prod_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sql = "INSERT INTO favourite (user_ID, prod_ID, prod_name, prod_price, prod_image)
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $user_ID, $prod_ID, $prod_name, $prod_price, $prod_image);
        $stmt->execute();
    } else {
        // If the product is not in the cart, insert it
    }

    $stmt->close();
    $conn->close();
    exit();
}
