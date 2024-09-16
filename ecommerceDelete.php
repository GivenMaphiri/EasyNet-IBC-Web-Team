<?php
// Include your database connection file
session_start();
include "DBConn.php";

// Get the product ID from the URL
$productId = $_GET['id'];

// Prepare and execute the delete query
$sql = "DELETE FROM products WHERE prod_ID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $productId);
mysqli_stmt_execute($stmt);

// Check if the deletion was successful
if (mysqli_stmt_affected_rows($stmt) > 0) {
    // Redirect back to the main page or display a success message
    header("Location: ecommerce.php");
    exit();
} else {
    echo "Error deleting product.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>