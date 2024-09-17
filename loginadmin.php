<?php

session_start();
include "DBConn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);

    // Query the database for the email
    $sql = "SELECT * FROM admin WHERE admin_email='$admin_email' AND admin_password='$admin_password'";
    $result = mysqli_query($conn, $sql);

    // Check if a row is returned (if email and password match)
    if (mysqli_num_rows($result) == 1) {
        // Fetch admin data
        $admin = mysqli_fetch_assoc($result);

        // Store admin details in the session (for later use)
        $_SESSION['admin_ID'] = $admin['admin_ID'];
        $_SESSION['admin_email'] = $admin['admin_email'];

        // Redirect to the admin dashboard
        header("Location: admin.php");
        exit();
    } else {
        // Invalid login credentials
        echo "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNet IBC | Admin Login</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
    <link href="_styles/style.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <header>
        <div id="left">
            <a href="index.php"><img src="_images/_logos/easynet.png" id="logo" width="120px" title="EasyNet Homepage" /></a>
        </div>
        <input type="checkbox" id="check" />
        <div id="middle">
            <nav>
                <ul id="nav_content">
                    <li id="nav_link">
                        <a href="index.php" id="nav_text">Home</a>
                    </li>
                    <li id="nav_link">
                        <a href="about.php" id="nav_text" class="active">About Us</a>
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
                                            $manufacturer = htmlspecialchars($row['prod_manufacturer']);
                                            echo "<li><a href='products2.php?category=$category&manufacturer=" . urlencode($manufacturer) . "'>$manufacturer</a></li>";
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
                                            $manufacturer = htmlspecialchars($row['prod_manufacturer']);
                                            echo "<li><a href='products2.php?category=$category&manufacturer=" . urlencode($manufacturer) . "'>$manufacturer</a></li>";
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
                                            $manufacturer = htmlspecialchars($row['prod_manufacturer']);
                                            echo "<li><a href='products2.php?category=$category&manufacturer=" . urlencode($manufacturer) . "'>$manufacturer</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="row">
                                    <h4><a href="products2.php?category=all">All</a></h4>
                                    <ul class="mega-link">
                                        <?php
                                        $sql = "SELECT DISTINCT prod_manufacturer FROM products LIMIT 10";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            $manufacturer = htmlspecialchars($row['prod_manufacturer']);
                                            echo "<li><a href='products2.php?manufacturer=" . urlencode($manufacturer) . "'>$manufacturer</a></li>";
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
                    echo "<p id='welcomemess'>Welcome, $first_name! <a href='manageaccount.php' id='logoutlink'>Manage Account</a></p>";
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
                <i class="bx bx-menu" id="menu_icon"></i>
                <i class="bx bx-x" id="close_icon"></i>
            </label>
        </div>
        <script src="_javascript/index.js"></script>
    </header>



    <style>
        form {

            width: 200px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;

        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }

        #ad_login {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 30vh;
            width: 200px;
            margin-left: 40vw;
        }
    </style>

    <div id="ad_login">
        <h1>Admin Login</h1>
        <form action="loginadmin.php" method="POST">
            <label for="admin_email">Email:</label>
            <input type="email" id="admin_email" name="admin_email" required>
            <br>
            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>


</body>

</html>