<?php
session_start();
include "DBConn.php";

if (isset($_POST['submit-btn-2'])) {
  $filter_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
  $first_name = mysqli_real_escape_string($conn, $filter_name);

  $filter_last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
  $last_name = mysqli_real_escape_string($conn, $filter_last_name);

  $filter_phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_STRING);
  $phone_number = mysqli_real_escape_string($conn, $filter_phone_number);

  $filter_email_address = filter_var($_POST['email_address'], FILTER_SANITIZE_STRING);
  $email_address = mysqli_real_escape_string($conn, $filter_email_address);

  $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $password = mysqli_real_escape_string($conn, $filter_password);

  $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
  $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

  $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email_address = '$email_address'") or die('query failed');

  // Hashing the password using password_hash
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);
  $CpasswordHash = password_hash($cpassword, PASSWORD_BCRYPT);

  //Check for user repeats
  if (mysqli_num_rows($select_user) > 0) {
    $message[] = 'user already exists';
  } else {
    if ($password != $cpassword) {
      $message[] = 'Passwords are not the same';
    } else {
      mysqli_query($conn, "INSERT INTO users (first_name, last_name, phone_number, email_address, password) VALUES ('$first_name', '$last_name', '$phone_number', '$email_address', '$passwordHash')")
        or die('query failed');
      $message[] = 'registration successful';
      // **Trigger confirmation alert after successful registration**
      echo '<script>alert("Client Added succesfully!")</script>';
      header('loactaion:users.php');
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyNet Dashboard | Add Clients</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
  <!-- line awesome cdn link  -->
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!-- custom css file link  -->
  <link rel="stylesheet" href="_styles/admin_style.css" />

</head>

<body>


  <div class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-flex">
        <div class="checkout_heading">
          <h1 id="Logo_name1">Easy</h1>
          <h1 id="Logo_name2">Net</h1>
        </div>
        <!-- <div class="brand-icons">
            <span class="las la-bell"></span>
            <span class="las la-user-circle"></span>
          </div>
      -->
      </div>
    </div>

    <div class="sidebar-main">
      <div class="sidebar-user">
        <div class="menu-head">
          <span>Admin</span>
        </div>
        <span>admin@gmail.com</span>
      </div>
    </div>

    <div class="sidebar-menu">
      <div class="menu-head">
        <span>Dashboard</span>
      </div>
      <ul>
        <li>
          <a href="admin.php">
            <span class="las la-chart-bar"></span>
            Analytics
          </a>
        </li>
        <li>
          <a href="orders.php">
            <span class="las la-shopping-cart"></span>
            Order
          </a>
        </li>
      </ul>

      <div class="menu-head">
        <span>Application</span>
      </div>
      <ul>
        <li>
          <a href="ecommerce.php">
            <span class="las la-store-alt"></span>
            Ecommerce
          </a>
        </li>
        <li>
          <a href="messages.php">
            <span class="las la-envelope"></span>
            Messages
          </a>
        </li>
        <li>
          <a href="users.php">
            <span class="las la-check-circle"></span>
            Clients
          </a>
        </li>
        <li>
          <a href="index.php">
            <span class="las la-sign-out-alt"></span>
            Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
  </div>

  <div class="main-content">

    

    <main>
        <div class="container my-5">
            <h2>Add New Client</h2>
            <form action="clientAdd.php" method="post" class="form-box">
      <!-- Personal Info -->

      <div id="signup_container">
        <?php
        if (isset($message)) {
          foreach ($message as $message) {
            echo '
              <div id = "message">
              <span> ' . $message . '</span>
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
          <div>
            <br>
            <button type="submit" name="submit-btn-2" class="signup_button">Sign Up</button>
          </div>
        </div>
      </div>
    </form>
        </div>
    </main>


    <script>
      function showAlert() {
        alert("Client Added succesfully!");
      }
    </script> 

  </div>

</body>

</html>