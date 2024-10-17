<?php
session_start();
include "DBConn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  if (empty($email) || empty($password)) {
    header("Location: login.php?error=All fields are required");
    exit();
    } else {
    // Adjusted SQL query to match the 'users' table structure
    $sql = "SELECT * FROM users WHERE email_address='$email'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verifying the password hash
        if (password_verify($password, $row['password'])) {
          $_SESSION['email'] = $email;
          $_SESSION['user_id'] = $row['user_ID'];
          unset($_SESSION['error_message']); // Clear error message on successful login
          header("Location: index.php");
          exit();
        } else {
          $error_message = "Incorrect password";
          $_SESSION['error_message'] = $error_message; // Store error message in session
        }
      } else {
        $error_message = "Incorrect email address or password";
        $_SESSION['error_message'] = $error_message; // Store error message in session
      }
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      exit();
    }
  }
}

// Check if there's an error message in the session
if (isset($_SESSION['error_message'])) {
  $error_message = $_SESSION['error_message'];
  unset($_SESSION['error_message']); // Clear the error message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyNet IBC | Sign Up</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
  <link href="_styles/style.css" rel="stylesheet" />
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
            <a href="index.php" id="nav_text">Home</a>
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
      <p>
        <a href="register.php" id="loginlinks">Sign Up</a> /
        <a href="login.php" id="loginlinks">Log In</a>    /
        
      </p>
      <a href="loginadmin.php" id="loginlinks">Admin</a>
      <div id="right-item">
        <a href="favourites.php"><img id="icons_heart" src="_images/_icons/heart.png" width="30px" /></a>
        <a href="checkout.php"><img id="icons_bag" src="_images/_icons/bag.png" width="30px" /></a>
      </div>
      <label for="check" class="menu">
        <i class="bx bx-menu" id="menu_icon"></i>
        <i class="bx bx-x" id="close_icon"></i>
      </label>
    </div>
  </header>

  <main class="login">
    /*--------Login box---------*/
    <form action="login.php" method="post" class="form-box">



      <!-- Replace "login.php" with your backend script -->
      <div id="login_container">
      
      <div class="notification" id="notification">
        <?php if (!empty($error_message)) echo $error_message; ?>
      </div>

        <script>
            // Show the notification if there's an error message
            window.onload = function() {
                var notification = document.getElementById('notification');
                if (notification.innerHTML) {
                    notification.style.display = 'block';
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 6000); // Hide after 5 seconds
                }
            };
        </script>

        <h1 id="login_heading">Login</h1>
        <div>

          <input id="email" type="email" name="email" placeholder="Email" class="signup_box" required />
        </div>
        <span id="emailError" class="error"></span>

        <div>
          <input id="password" type="password" name="password" placeholder="Password" class="signup_box" required />
        </div>

        <span id="passwordError" class="error"></span>

        <div id="two-col">
          <div id="one">
            <input type="checkbox" id="register-check">
            <label for="register-check"> Remember Me</label>
          </div>
          <div id="two">
            <button type="submit" id="login_button">Login</button>
          </div>
        </div>

      </div>
    </form>

    <Script src="login.js"></Script>


    <!-- <script>
      // Get the login button element
      const loginButton = document.getElementById('login_button');

      // Add click event listener to the button
      loginButton.addEventListener('click', () => {
        // Redirect to admin.php on click
        window.location.href = "admin.php";
      });
    </script> -->


  </main>
</body>

</html>