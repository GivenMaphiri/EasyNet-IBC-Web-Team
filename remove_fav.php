<?php
session_start();
include "DBConn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $prod_id = $_POST['prod_id'];

        // Delete the product from the favourites table
        $sql = "DELETE FROM favourite WHERE user_id = ? AND prod_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $prod_id);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'not_logged_in';
    }
} else {
    echo 'invalid_request';
}

$conn->close();
