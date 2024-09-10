<?php
session_start();
include "DBConn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Make sure the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $prod_id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name'];
        $prod_price = $_POST['prod_price'];
        $prod_image = $_POST['prod_image'];

        // Check if the product is already in favourites
        $check_sql = "SELECT * FROM favourite WHERE user_id = ? AND prod_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ii", $user_id, $prod_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows == 0) {
            // Insert into favourites table
            $sql = "INSERT INTO favourite (user_id, prod_id, prod_name, prod_price, prod_image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisss", $user_id, $prod_id, $prod_name, $prod_price, $prod_image);

            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'error';
            }
            $stmt->close();
        } else {
            echo 'already_exists';
        }
        $check_stmt->close();
    } else {
        echo 'not_logged_in';
    }
} else {
    echo 'invalid_request';
}

$conn->close();
