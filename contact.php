<?php

session_start();
include "DBConn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyNet IBC | Contact Us</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
  <link href="_styles/font-awesome.css" rel="stylesheet" />
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
            <a href="contact.php" id="nav_text" class="active">Contact Us</a>
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
        <i class='bx bx-menu' id="menu_icon"></i>
        <i class='bx bx-x' id="close_icon"></i>
      </label>
    </div>
  </header>
  <main>
    <div id="background_contact">
      <h1>Contact Us</h1>
      <h2>Have any enquiries? Email or give us a call</h2>
    </div>
    <div id="contact_body">

      <!--
          <div class="contact_info">

            <h3 id="contact_headings">Contact Details</h3>
            <hr id="lines">
            <h4 id="contact_headings">Email</h4>
            <hr id="lines_small">
            <ul id="contact_list">
                <li>sales@easynetbusiness.co.za</li>
                <li>dikeledi@easynetbusiness.co.za</li>
            </ul>
            <h4 id="contact_headings">Contact Numbers</h4>
            <hr id="lines_small">
            <ul id="contact_list">
                <li>0124336486</li>
                <li>Fax - 0865357398</li>
            </ul>
            <h3 id="contact_headings">Give us Feedback!</h3>
            <p2 >and we will contact you!</p2>

          </div>

        -->
      <div class="address_info">
        <h3 id="contact_headings">Physical Address</h3>
        <hr id="lines">
        <p id="contact_paragraph">570 Fehrsen Street Brooklyn Bridge Office Park 3rd Floor Steven House Brooklyn, P.O Box 911-2045 Rosslyn,0200</p>
        <iframe id="contact_map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.9920632807375!2d28.23242579765772!3d-25.77082569999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e9561098f4732c1%3A0xfa0a174476b2eef4!2sBrooklyn%20Bridge!5e0!3m2!1sen!2sza!4v1685230780304!5m2!1sen!2sza" width="75%" height="450px" style="border:solid;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

      </div>


      <div class="contact_info">

        <h3 id="contact_headings">Contact Details</h3>
        <hr id="lines">
        <h4 id="contact_headings">Email</h4>
        <hr id="lines_small">
        <ul id="contact_list">
          <li><a href="mailto:sales@easynetbusiness.co.za">sales@easynetbusiness.co.za</a></li>
          <li><a href="mailto:dikeledi@easynetbusiness.co.za">dikeledi@easynetbusiness.co.za</a></li>
        </ul>
        <h4 id="contact_headings">Contact Numbers</h4>
        <hr id="lines_small">
        <ul id="contact_list">
          <li>(012)433 6486</li>
          <li>Fax - 086 535 7398</li>
        </ul>
        <h3 id="contact_headings">Give us Feedback!</h3>
        <p2>and we will contact you!</p2>

      </div>

    </div>

    <div class="contact_form">
      <h1>Contact Us</h1>

      <form id="contactForm" action="processForm.php" method="post">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message_us" name="message" required></textarea>

        <button type="submit" value="submit" name="submit">Send Message</button>
      </form>
    </div>



    <!--<script src="_javascript/contact.js"></script>  -->




  </main>
  <footer>
    <hr id="foot_line" />
    <div class="content">
      <div class="box">
        <img src="_images/_logos/easynet.png">
      </div>

      <div class="box">
        <h3>My Account</h3>
        <a href=""> <i class="bx bx-chevron-right"></i>My account </a>
        <a href=""> <i class="bx bx-chevron-right"></i>Order history </a>
        <a href=""> <i class="bx bx-chevron-right"></i>Wishlist </a>
      </div>

      <div class="box">
        <h3>Information</h3>
        <a href=""> <i class="bx bx-chevron-right"></i>Delivery information </a>
        <a href=""> <i class="bx bx-chevron-right"></i>Privacy policy </a>
      </div>

      <div class="box">
        <h3>Categories</h3>
        <a href=""> <i class="bx bx-chevron-right"></i>Hardware </a>
        <a href=""> <i class="bx bx-chevron-right"></i>Software </a>
        <a href=""> <i class="bx bx-chevron-right"></i>Accessories</a>
        <a href=""> <i class="bx bx-chevron-right"></i>Combo</a>
      </div>

      <div class="box">
        <h3><a href="contact.php">Contact Us</a> </h3>
        <p><i class="bx bxs-phone"></i>(012)433 6486</p>
        <p><i class="bx bxs-phone"></i>086 535 7398</p>
        <p><i class="bx bxs-envelope"></i><a href="mailto:sales@easynetbusiness.co.za">sales@easynetbusiness.co.za</a></p>
        <p><i class="bx bxs-envelope"></i><a href="mailto:dikeledi@easynetbusiness.co.za">dikeledi@easynetbusiness.co.za</a></p>
        <p><i class="bx bxs-loaction-plus"></i>Brooklyn, Pretoria</p>
      </div>
    </div>

    <div class="social-media-icons">
      <a href="https://www.facccebook.com/" target="_blank"> <i class='bx bxl-facebook-circle'>
          <p>Facebook</p>
        </i>
      </a>
      <a href="https://www.innnstagram.com/" target="_blank"> <i class='bx bxl-instagram'>
          <p>Instagram</p>
        </i>
      </a>
      <a href="https://www.linkkkedin.com/feed/?trk=guest_homepage-basic_google-one-tap-submit" target="_blank"><i class='bx bxl-linkedin-square'>
          <p>LinkedIn</p>
        </i>
      </a>
    </div>

    <div class="bottom">
      <hr id="foot_line" />
      <p id="footer_text">
        Copyright &copy; 2024 EasyNet In Business Communications
      </p>
    </div>
  </footer>
</body>

</html>