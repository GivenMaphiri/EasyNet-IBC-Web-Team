<?php

session_start();
include "DBConn.php";

if (isset($_POST['add_to_cart'])) {
    $prod_ID = $_POST['prod_ID'];
    $prod_name = $_POST['prod_name'];
    $prod_price = $_POST['prod_price'];
    $prod_image = $_POST['prod_image'];
    $quantity = 1; // Default quantity

    // For this example, we'll use userId = 1
    $user_ID = 1;

    // Check if the product is already in the cart for this user
    $sql = "SELECT * FROM cart WHERE user_ID = ? AND prod_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_ID, $prod_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the product is already in the cart, update the quantity
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_ID = ? AND prod_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_ID, $prod_ID);
        $stmt->execute();
    } else {
        // If the product is not in the cart, insert it
        $sql = "INSERT INTO cart (user_ID, prod_ID, prod_name, prod_price, prod_image, quantity, cart_excTotal, cart_VAT, cart_incTotal)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $cart_excTotal = $prod_price * $quantity;
        $cart_VAT = $cart_excTotal * 0.20; // Assuming VAT is 15%
        $cart_incTotal = $cart_excTotal + $cart_VAT;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssdddd", $user_ID, $prod_ID, $prod_name, $prod_price, $prod_image, $quantity, $cart_excTotal, $cart_VAT, $cart_incTotal);
        $stmt->execute();
    }

    // Redirect back to the product page or cart view page
    $stmt->close();
    $conn->close();
    exit();
}
