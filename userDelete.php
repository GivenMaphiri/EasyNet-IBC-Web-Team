<?php
// Include your database connection file
session_start();
include "DBConn.php";

// Get the product ID from the URL
$userID = $_GET['id'];

 
// Prepare and execute the delete query
$sql_users = "DELETE FROM users WHERE user_ID = ?";
$stmt_users = mysqli_prepare($conn, $sql_users);
mysqli_stmt_bind_param($stmt_users, "i", $userID);
mysqli_stmt_execute($stmt_users);

// Check if the deletion was successful
if (mysqli_stmt_affected_rows($stmt_users) > 0) {

// Prepare and execute the delete query for shipping
//  $sql_shipping = "DELETE FROM shipping WHERE user_ID = ?";
//  $stmt_shipping = mysqli_prepare($conn, $sql_shipping);
//  mysqli_stmt_bind_param($stmt_shipping, "i", $userID);
//  mysqli_stmt_execute($stmt_shipping);

// // Prepare and execute the delete query for orders
// $sql_orders = "DELETE FROM orders WHERE user_ID = ?";
// $stmt_orders = mysqli_prepare($conn, $sql_orders);
// mysqli_stmt_bind_param($stmt_orders, "i", $userID);
// mysqli_stmt_execute($stmt_orders);
 

    // Redirect back to the main page or display a success message
    header("Location: users.php");
    exit();
} else {
    header("Location: users.php");
    //echo "Error deleting user.";
}

mysqli_stmt_close($stmt_users);
// mysqli_stmt_close($stmt_shipping);
// mysqli_stmt_close($stmt_orders);
mysqli_close($conn);
?>