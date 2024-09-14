<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNet IBC | Manage Account</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link href="_styles/style.css" rel="stylesheet" />
    <link href="_styles/font-awesome.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <div id="left">
            <a href="index.php"><img src="_images/_logos/easynet.png" id="logo" width="120px" title="EasyNet Homepage" /></a>
        </div>
        <input type="checkbox" id="check">
        <div id="middle">
            <nav>
                <ul id="nav_content">
                    <li id="nav_link">
                        <a href="index.php" id="nav_text" class="active">Home</a>
                    </li>
                    <li id="nav_link">
                        <a href="about.php" id="nav_text">About Us</a>
                    </li>
                    <li id="nav_link">
                        <a href="products.php" id="nav_text">Products</a>
                        <div class="dropdown">
                            <div class="dropdown-content">
                                <div class="row">
                                    <h4><a href="products2.php?category=Hardware">Hardware</a></h4>
                                    <ul class="mega-link">
                                        <?php
                                        $category = 'Hardware';
                                        $sql = "SELECT DISTINCT prod_manufacturer FROM products WHERE prod_type = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $category);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<li>" . htmlspecialchars($row['prod_manufacturer']) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="row">
                                    <h4><a href="products2.php?category=Software">Software</a></h4>
                                    <ul class="mega-link">
                                        <?php
                                        $category = 'Software';
                                        $sql = "SELECT DISTINCT prod_manufacturer FROM products WHERE prod_type = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $category);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<li>" . htmlspecialchars($row['prod_manufacturer']) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="row">
                                    <h4><a href="products2.php?category=Accessories">Accessories</a></h4>
                                    <ul class="mega-link">
                                        <?php
                                        $category = 'Accessories';
                                        $sql = "SELECT DISTINCT prod_manufacturer FROM products WHERE prod_type = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $category);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<li>" . htmlspecialchars($row['prod_manufacturer']) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="row">
                                    <h4><a href="products2.php">Combos</a></h4>
                                    <ul class="mega-link">
                                        <?php
                                        $category = 'Combos';
                                        $sql = "SELECT DISTINCT prod_manufacturer FROM products WHERE prod_type = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $category);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<li>" . htmlspecialchars($row['prod_manufacturer']) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="row">
                                    <h4><a href="products2.php?category=all">All</a></h4>
                                    <ul class="mega-link">
                                        <?php
                                        $sql = "SELECT DISTINCT prod_manufacturer FROM products";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<li>" . htmlspecialchars($row['prod_manufacturer']) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="nav_link">
                        <a href="client.php" id="nav_text">Partners and Clients</a>
                    </li>
                    <li id="nav_link">
                        <a href="contact.php" id="nav_text">Contact Us</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div id="right">
            <?php

            if (isset($_SESSION['user_id'])) {
                // The user is logged in, fetch their first name
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT first_name FROM users WHERE user_ID='$user_id'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    $first_name = htmlspecialchars($row['first_name']);
                    echo "<p id='welcomemess'>Welcome, $first_name! <a href='logout.php' id='logoutlink'>Manage Account</a></p>";
                } else {
                    // Handle the case where the user is not found, if necessary
                    echo "<p>Error: User not found.</p>";
                }
            } else {
                // The user is not logged in, show the Sign Up / Log In links
                echo '<p>
            <a href="register.php" id="loginlinks">Sign Up</a> /
            <a href="login.php" id="loginlinks">Log In</a>
          </p>';
            }
            ?>
            <div id="right-item">
                <a href="favourites.php"><img id="icons_heart" src="_images/_icons/heart.png" width="30px" /></a>
                <a href="checkout.php"><img id="icons_bag" src="_images/_icons/bag.png" width="30px" /></a>
            </div>

            <label for="check" class="menu">
                <i class='bx bx-menu' id="menu_icon"></i>
                <i class='bx bx-x' id="close_icon"></i>
            </label>

        </div>

        </div>
        <script src="_javascript/index.js"></script>
    </header>

    <main>
        <div id="background_account">
            <h1>Manage Account</h1>
            <h2>View and Edit your Account Details</h2>
        </div>

        <div class="shipping_heading">
            <h1>Account Information</h1>
        </div>
        <hr id="checkout_lines">
        <?php
        $user_id = $_SESSION['user_id'];

        // Fetch user information
        $query = "SELECT first_name, last_name, phone_number, email_address FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Check if the form is submitted to update the user information
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $new_password = $_POST['pass'];

            // If the user entered a new password, hash it
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $query = "UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, email_address = ?, password = ? WHERE user_ID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sssssi', $firstname, $lastname, $phone, $email, $hashed_password, $user_id);
            } else {
                // If no new password, update the rest without changing the password
                $query = "UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, email_address = ? WHERE user_ID = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssssi', $firstname, $lastname, $phone, $email, $user_id);
            }

            if ($stmt->execute()) {
                echo "Account information updated successfully.";
            } else {
                echo "Error updating account information.";
            }
        }

        ?>
        <div id="shipping_con">
            <form method="post">
                <div id="shipping_info">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" class="acc_name" id="ship_text" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>

                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" class="acc_lastname" id="ship_text" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>

                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" class="acc_phone" pattern="[0-9]+" title="Please enter numbers only" id="ship_text" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" class="acc_email" id="ship_text" value="<?php echo htmlspecialchars($user['email_address']); ?>" required>

                    <label for="pass">New Password (Leave blank if you don't want to change):</label>
                    <input type="password" name="pass" class="acc_pass" id="ship_text" placeholder="Enter new password">

                    <button type="submit" id="save_acc">Update Account Information</button>
                </div>
            </form>
        </div>
        <div class="shipping_heading">
            <h1>Order History</h1>
        </div>
        <hr id="checkout_lines">
        <?php
        $user_ID = $_SESSION['user_id']; // Get the user ID from the session

        // Query to fetch grouped orders by date and time
        $sql = "SELECT COUNT(DISTINCT placed_on) AS order_num, 
                   GROUP_CONCAT(order_ID SEPARATOR ', ') AS order_ids, 
                   SUM(order_total) AS total_price, 
                   DATE_FORMAT(placed_on, '%Y-%m-%d %H:%i:%s') AS order_datetime 
            FROM orders 
            WHERE user_ID = ? 
            GROUP BY DATE_FORMAT(placed_on, '%Y-%m-%d %H:%i:%s') 
            ORDER BY placed_on DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>Order Number</th><th>Order IDs</th><th>Total Price</th><th>Date & Time Ordered</th></tr></thead>";
            echo "<tbody>";

            $order_number = 1; // Initialize a new order number
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $order_number++ . "</td>"; // Increment order number for each group
                echo "<td>" . $row['order_ids'] . "</td>"; // Display grouped order IDs
                echo "<td>R" . number_format($row['total_price'], 2) . "</td>"; // Total price for the group
                echo "<td>" . $row['order_datetime'] . "</td>"; // Date and time ordered
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No orders found.</p>";
        }

        $stmt->close();
        ?>



    </main>
</body>

</html>