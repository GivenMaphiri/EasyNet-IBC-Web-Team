<?php
session_start();
include "DBConn.php";

// if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['phone_number']) && isset($_POST['email']) && isset($_POST['password'])) {

//     function validate($data){
//         $data = trim($data);
//         $data = stripslashes($data);
//         $data = htmlspecialchars($data);
//         return $data;
//     }

//     $first_name = validate($_POST['first_name']);
//     $last_name = validate($_POST['last_name']);
//     $phone_number = validate($_POST['phone_number']);
//     $email_address = validate($_POST['email']);
//     $password = validate($_POST['password']);
//     $cpassword = validate($_POST['cpassword']);

//     if (empty($first_name) || empty($last_name) || empty($phone_number) || empty($email_address) || empty($password)|| empty($cpassword)) {
//         header("Location: register.php?error=All fields are required");
//         exit();
//     } else {
//         // Hashing the password using password_hash
//         $passwordHash = password_hash($password, PASSWORD_BCRYPT);
//         $CpasswordHash = password_hash($cpassword, PASSWORD_BCRYPT);

//         // Set the verification status to "unverified"
//         $verificationStatus = 'unverified';

      //   $sql = "INSERT INTO users (first_name, last_name, phone_number, email_address, password) VALUES ('$first_name', '$last_name', '$phone_number', '$email_address', '$passwordHash')";

       
      //   //Check for user repeats
      // if(users($sql)>0){
      //   $message[] = 'user already exists';
      // }else{ if($password != $cpassword ){
      //     $message[] = 'wrong password';
      //   }}

//       if (mysqli_query($conn, $sql)) {
//            header("Location: login.php?");
//            echo "Registration successful";
//           // exit();
//         } else {
//            header("Location: register.php?error=Registration failed");
//            echo "Something went wrong!";
//             exit();
//             }
//           }

       if(isset($_POST['submit-btn']))  
       {
        $filter_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $first_name = mysqli_real_escape_string($conn, $filter_name);

        $filter_last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        $last_name= mysqli_real_escape_string($conn, $filter_last_name);

        $filter_phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_STRING);
        $phone_number = mysqli_real_escape_string($conn, $filter_phone_number);

        $filter_email_address = filter_var($_POST['email_address'], FILTER_SANITIZE_STRING);
        $email_address = mysqli_real_escape_string($conn, $filter_email_address);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

        $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email_address = '$email_address'") or die ('query failed');

         // Hashing the password using password_hash
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $CpasswordHash = password_hash($cpassword, PASSWORD_BCRYPT);
       
        //Check for user repeats
      if(mysqli_num_rows($select_user)>0){
        $message[] = 'user already exists';
      }else{ if($password != $cpassword ){
          $message[] = 'Passwords are not the same';
        }else{
          mysqli_query($conn, "INSERT INTO users (first_name, last_name, phone_number, email_address, password) VALUES ('$first_name', '$last_name', '$phone_number', '$email_address', '$passwordHash')")
          or die('query failed');
          $message[]='registration successful';
          header('loactaion:login.php');
        }}
       } 
      //}
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
      <p>
        <a href="register.php" id="loginlinks">Sign Up</a> /
        <a href="login.php" id="loginlinks">Log In</a>
      </p>
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

  <main class="login2">
    <h1 id="register_heading">Sign Up</h1>

    <form action="register.php" method="post" class="form-box">
      <!-- Personal Info -->

      <div id="signup_container">
        <?php
          if (isset($message)){
            foreach ($message as $message){
              echo'
              <div id = "message">
              <span> '.$message.'</span>
              <i id = "bi bi-x-circle" onclick="this.parentElement.remove()"></i>
              </div>';
            }
          }
        ?>

        <div id="signup_left">
          <h4>First Name</h4>
          <input type="text" name="first_name" placeholder="First Name" class="signup_box" required />
          <h4>Last Name</h4>
          <input type="text" name="last_name" class="signup_box" placeholder="Last Name" required />
          <h4>Phone number</h4>
          <input type="text" name="phone_number" placeholder="Phone Number" class="signup_box" required />
        </div>

        <!-- Sign Up -->
        <div id="signup_right">
          <h4> Email address</h4>
          <input type="email" name="email_address" placeholder="Email Address" class="signup_box" required />
          <h4>Password</h4>
          <input type="password" name="password" placeholder="Password" class="signup_box" required />
          <h4>Confirm password</h4>
          <input type="password" name="cpassword" placeholder="Confirm Password" class="signup_box" required />
          <h4>already have an account? <a href ="login.php">login now </a></h4>
          <div>
            <button type="submit" name="submit-btn" class="signup_button">Sign Up</button>
          </div>
        </div>
      </div>
    </form>
  </main>
</body>

</html>