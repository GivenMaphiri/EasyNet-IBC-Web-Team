<?php
// Include your database connection file
session_start();
include "DBConn.php";

// Get the order ID and new status from the form
$orderId = $_POST['order_id'];
$newStatus = $_POST['status'];

// Update the order status in the database
$sql = "UPDATE orders SET status = ? WHERE order_ID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $newStatus, $orderId);
mysqli_stmt_execute($stmt);

// Redirect back to the orders page or display a success message
header("Location: orders.php");
exit();