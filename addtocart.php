<?php
session_start();
include "DBConn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Make sure the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_ID = $_SESSION['user_id']; // Retrieve the user ID from the session
        $prod_ID = $_POST['prod_ID'];
        $prod_name = $_POST['prod_name'];
        $prod_price = $_POST['prod_price'];
        $prod_image = $_POST['prod_image'];
        $quantity = 1; // Default quantity

        // Check if the product is already in the cart for this user
        $check_sql = "SELECT * FROM cart WHERE user_ID = ? AND prod_ID = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ii", $user_ID, $prod_ID);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // If the product is already in the cart, update the quantity
            $update_sql = "UPDATE cart SET quantity = quantity + 1, cart_excTotal = cart_excTotal + ?, cart_VAT = cart_excTotal * 0.20, cart_incTotal = cart_excTotal + cart_VAT 
                           WHERE user_ID = ? AND prod_ID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("dii", $prod_price, $user_ID, $prod_ID);
            if ($update_stmt->execute()) {
                echo 'updated';
            } else {
                echo 'error';
            }
            $update_stmt->close();
        } else {
            // If the product is not in the cart, insert it
            $insert_sql = "INSERT INTO cart (user_ID, prod_ID, prod_name, prod_price, prod_image, quantity, cart_excTotal, cart_VAT, cart_incTotal)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $cart_excTotal = $prod_price * $quantity;
            $cart_VAT = $cart_excTotal * 0.20; // Assuming VAT is 20%
            $cart_incTotal = $cart_excTotal + $cart_VAT;

            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("iisssdddd", $user_ID, $prod_ID, $prod_name, $prod_price, $prod_image, $quantity, $cart_excTotal, $cart_VAT, $cart_incTotal);

            if ($insert_stmt->execute()) {
                echo 'Product Added to Cart!';
            } else {
                echo 'error';
            }
            $insert_stmt->close();
        }
        $check_stmt->close();
    } else {
        echo 'Please logged in to add to cart!';
    }
} else {
    echo 'invalid_request';
}

$conn->close();
