<?php
// Include your database connection file
session_start();
include "DBConn.php";

// Get the user ID from the URL
$userID = $_GET['id'];

// Check for dependencies
$sql_cart_count = "SELECT COUNT(*) FROM cart WHERE user_ID = ?";
$stmt_cart_count = mysqli_prepare($conn, $sql_cart_count);
mysqli_stmt_bind_param($stmt_cart_count, "i", $userID);
mysqli_stmt_execute($stmt_cart_count);
mysqli_stmt_bind_result($stmt_cart_count, $cart_count);
mysqli_stmt_fetch($stmt_cart_count);
mysqli_stmt_close($stmt_cart_count);

$sql_favourite_count = "SELECT COUNT(*) FROM favourite WHERE user_ID = ?";
$stmt_favourite_count = mysqli_prepare($conn, $sql_favourite_count);
mysqli_stmt_bind_param($stmt_favourite_count, "i", $userID);
mysqli_stmt_execute($stmt_favourite_count);
mysqli_stmt_bind_result($stmt_favourite_count, $favourite_count);
mysqli_stmt_fetch($stmt_favourite_count);
mysqli_stmt_close($stmt_favourite_count);

$sql_orders_count = "SELECT COUNT(*) FROM orders WHERE user_ID = ?";
$stmt_orders_count = mysqli_prepare($conn, $sql_orders_count);
mysqli_stmt_bind_param($stmt_orders_count, "i", $userID);
mysqli_stmt_execute($stmt_orders_count);
mysqli_stmt_bind_result($stmt_orders_count, $orders_count);
mysqli_stmt_fetch($stmt_orders_count);
mysqli_stmt_close($stmt_orders_count);

$sql_shipping_count = "SELECT COUNT(*) FROM shipping WHERE user_ID = ?";
$stmt_shipping_count = mysqli_prepare($conn, $sql_shipping_count);
mysqli_stmt_bind_param($stmt_shipping_count, "i", $userID);
mysqli_stmt_execute($stmt_shipping_count);
mysqli_stmt_bind_result($stmt_shipping_count, $shipping_count);
mysqli_stmt_fetch($stmt_shipping_count);
mysqli_stmt_close($stmt_shipping_count);

// Display confirmation message if dependencies found
if ($cart_count > 0 || $favourite_count > 0 || $orders_count > 0 || $shipping_count > 0) {
    echo "This user has associated records in other tables. Deleting this user will also delete these records as well as any associated orders. Are you sure you want to proceed?
    <form action='userDelete.php' method='post'>
        <input type='hidden' name='userId' value='$userID'>
        <button type='submit'>Confirm Delete</button>
        <a href='users.php'>Cancel</a>
    </form>";
} else {
    // Proceed with deletion
    $sql_cart = "DELETE FROM cart WHERE user_ID = ?";
    $stmt_cart = mysqli_prepare($conn, $sql_cart);
    mysqli_stmt_bind_param($stmt_cart, "i", $userID);
    mysqli_stmt_execute($stmt_cart);

    $sql_favourite = "DELETE FROM favourite WHERE user_ID = ?";
    $stmt_favourite = mysqli_prepare($conn, $sql_favourite);
    mysqli_stmt_bind_param($stmt_favourite, "i", $userID);
    mysqli_stmt_execute($stmt_favourite);

    $sql_orders = "DELETE FROM orders WHERE user_ID = ?";
    $stmt_orders = mysqli_prepare($conn, $sql_orders);
    mysqli_stmt_bind_param($stmt_orders, "i", $userID);
    mysqli_stmt_execute($stmt_orders);

    $sql_shipping = "DELETE FROM shipping WHERE user_ID = ?";
    $stmt_shipping = mysqli_prepare($conn, $sql_shipping);
    mysqli_stmt_bind_param($stmt_shipping, "i", $userID);
    mysqli_stmt_execute($stmt_shipping);

    $sql_users = "DELETE FROM users WHERE user_ID = ?";
    $stmt_users = mysqli_prepare($conn, $sql_users);
    mysqli_stmt_bind_param($stmt_users, "i", $userID);
    mysqli_stmt_execute($stmt_users);

    if (mysqli_stmt_affected_rows($stmt_users) > 0) {
        header("Location: users.php?success=deleted");
        exit();
    } else {
        header("Location: users.php?error=delete_failed");
        exit();
    }

    // Close statements and connection
    mysqli_stmt_close($stmt_cart);
    mysqli_stmt_close($stmt_favourite);
    mysqli_stmt_close($stmt_orders);
    mysqli_stmt_close($stmt_shipping);
    mysqli_stmt_close($stmt_users);
    mysqli_close($conn);
}