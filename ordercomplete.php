<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page or show an appropriate message
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link href="_styles/font-awesome.css" rel="stylesheet" />
    <link href="_styles/style.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    // Assuming you have a session that stores user ID
    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    // Query to fetch shipping info
    $sql = "SELECT shipping_name, shipping_street, shipping_phone FROM shipping WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch shipping details
        $shipping = $result->fetch_assoc();

        // Encode shipping data to be passed to JavaScript
        echo "<script> var shippingInfo = " . json_encode($shipping) . "; </script>";
    } else {
        echo "<p>No shipping information found.</p>";
    }
    ?>
    <?php
    $user_id = $_SESSION['user_id']; // Assuming the user_id is stored in the session

    // PHP code to retrieve cart data for the logged-in user
    $sql = "SELECT prod_name, prod_price, quantity, cart_incTotal FROM cart WHERE user_id = ?";

    // Assuming you have a session variable for user ID
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id); // Assuming $user_ID is the logged-in user's ID
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = [
                'prod_name' => $row['prod_name'],
                'prod_price' => $row['prod_price'],
                'quantity' => $row['quantity'],
                'cartIncVat' => $row['cart_incTotal']
            ];
        }
    }
    // Encode PHP array to JSON
    $cartItemsJson = json_encode($cartItems);
    ?>

    <!-- Add HTML to inform the user that the order was successfully placed -->
    <div id="placed_order">
        <img src="_images/_icons/check.png" width="70px" />
        <h1>Your order has been placed!</h1>
        <p>Thank you for your purchase. A receipt has been generated for your order.</p>
        <a href='logout.php'><button id="place_order">Log out</button></a>
        <a id="view_cart_link" href="index.php"><button id="view_cart">Back to Home Page</button></a>
    </div>

</body>

</html>