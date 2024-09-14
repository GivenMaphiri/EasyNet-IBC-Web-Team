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
    <title>EasyNet IBC | Shipping</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link href="_styles/style.css" rel="stylesheet" />
    <link href="_styles/font-awesome.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body id="body_ship">

    <div class="shipping">

        <div class="shipping_heading">
            <p id="backtocart"><a href='checkout.php' id='prod_back'>&#9664; Back to Cart</a></p>
            <h1>Shipping Information</h1>
        </div>
        <hr id="checkout_lines">

        <?php

        $user_ID = $_SESSION['user_id']; // Ensure user is logged in
        $sql = "SELECT * FROM shipping WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['shipping_name'];
            $street = $row['shipping_street'];
            $city = $row['shipping_city'];
            $province = $row['shipping_province'];
            $zip = $row['shipping_zip'];
            $phone = $row['shipping_phone'];
        } else {
            $name = $street = $city = $province = $zip = $phone = '';
        }

        ?>

        <div id="shipping_con">

            <form method="post" action="shippinginfo.php" onsubmit="return validateForm()">
                <div id="shipping_info">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="ship_name" id="ship_text" value="<?php echo htmlspecialchars($name); ?>" required></input>
                    <label for="street">Street Address:</label>
                    <input type="text" name="street" class="ship_street" id="ship_text" value="<?php echo htmlspecialchars($street); ?>" required></input>
                    <label for="city">City:</label>
                    <input type="text" name="city" class="ship_city" id="ship_text" value="<?php echo htmlspecialchars($city); ?>" required></input>
                    <label for="province">Province:</label>
                    <input type="text" name="province" class="ship_province" id="ship_text" value="<?php echo htmlspecialchars($province); ?>" required></input>
                    <label for="zip">Zip Code:</label>
                    <input type="text" name="zip" class="ship_zip" pattern="[0-9]+" title="Please enter numbers only" id="ship_text" value="<?php echo htmlspecialchars($zip); ?>" required></input>
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" class="ship_phone" pattern="[0-9]+" title="Please enter numbers only" id="ship_text" value="<?php echo htmlspecialchars($phone); ?>" required></input>
                    <button type="submit" id="save_ship">Save Shipping Information</button>
                </div>
            </form>


            <div id="order_summary">
                <?php

                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    $user_ID = $_SESSION['user_id'];

                    // SQL query to get the prices and quantities of the products in the user's cart
                    $sql = "SELECT prod_price, cart_incTotal, cart_VAT, quantity FROM cart WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_ID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $subtotal = 0;
                    $totalprice = 0;
                    $cartvat = 0;

                    // Calculate subtotal
                    while ($row = $result->fetch_assoc()) {
                        $totalprice += $row['cart_incTotal'] * $row['quantity'];
                        $subtotal += $row['prod_price'] * $row['quantity'];
                        $cartvat += $row['cart_VAT'] * $row['quantity'];
                    }
                } else {
                    // If the user is not logged in, set subtotal to 0
                    $subtotal = 0;
                    $cartvat = 0;
                    $totalprice = 0;
                }
                ?>

                <div>
                    <h3>Order Summary</h3>
                    <p id="order_info">Subtotal: R<?php echo number_format($subtotal, 2); ?></p>
                    <p id="order_info">Delivery Fee: R0.00</p>
                    <p id="order_info">VAT: R<?php echo number_format($cartvat, 2); ?></p>
                    <hr id="order_line">
                    <p id="order_info">Total Price: R<?php echo number_format($totalprice, 2); ?></p>
                </div>


                <form action="place_order.php" method="POST">
                    <div id="order_buttons">
                        <button type="submit" id="place_order">Place Order</button>
                        <a id="view_cart_link" href="checkout.php"><button id="view_cart">View Cart</button></a>
                    </div>
                </form>

            </div>
        </div>
        <script>
            function validateForm() {
                let zip = document.querySelector(".ship_zip").value;
                let phone = document.querySelector(".ship_phone").value;

                if (!/^[0-9]+$/.test(zip)) {
                    alert("Zip code must be numbers only.");
                    return false;
                }

                if (!/^[0-9]+$/.test(phone)) {
                    alert("Phone number must be numbers only.");
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>

</html>