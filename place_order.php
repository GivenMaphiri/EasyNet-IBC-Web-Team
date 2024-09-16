<?php
session_start();
include "DBConn.php";

// Assume the user's cart details are stored in session or retrieved from the database
$user_ID = $_SESSION['user_id']; // Get the logged-in user ID
$dateTime = date('Y-m-d H:i:s'); // Get current date and time

// Query to fetch the cart items for the current user
$sqlCart = "SELECT * FROM cart WHERE user_ID = ?";
$stmtCart = $conn->prepare($sqlCart);
$stmtCart->bind_param("i", $user_ID);
$stmtCart->execute();
$resultCart = $stmtCart->get_result();

if ($resultCart->num_rows > 0) {
    // Insert order for each product in the cart
    while ($cartRow = $resultCart->fetch_assoc()) {
        $prod_ID = $cartRow['prod_ID'];
        $order_total = $cartRow['cart_incTotal'] * $cartRow['quantity']; // Get the total with VAT

        // Insert into orders table
        $sqlInsertOrder = "INSERT INTO orders (user_ID, prod_ID, order_total, placed_on, payment_status, status) 
                           VALUES (?, ?, ?, ?, 'Due', 'Pending')";
        $stmtInsert = $conn->prepare($sqlInsertOrder);
        $stmtInsert->bind_param("iids", $user_ID, $prod_ID, $order_total, $dateTime);
        $stmtInsert->execute();
    }

    // 2. Clear the cart after placing the order
    $clearCartQuery = "DELETE FROM cart WHERE user_ID = ?";
    $clearCartStmt = $conn->prepare($clearCartQuery);
    $clearCartStmt->bind_param("i", $user_ID);
    $clearCartStmt->execute();


    // After successfully placing the order, redirect to a confirmation page and generate the PDF receipt
    header("Location: ordercomplete.php");
} else {
    echo "No items in cart";
}

$stmtCart->close();
$conn->close();
