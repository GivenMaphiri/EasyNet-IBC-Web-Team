<?php
session_start();
include "DBConn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="We specialise in providing IT solutions to all businesses" />
  <title>EasyNet IBC | About Us</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
  <link href="_styles/style.css" rel="stylesheet" />
  <link href="_styles/font-awesome.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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
          echo "<p id='welcomemess'>Welcome, $first_name! <a href='logout.php' id='logoutlink'>Logout</a></p>";
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
  </header>
  <main>
    <div id="background_about">
      <h1>About Us</h1>
      <h2>Find out more about what we do</h2>
    </div>
    <div id="about_paragraph">
      <p id="about_description">
        Easynet in Business Communication is a women owned IT Company, founded
        in 2007, intent on developing and delivering market driven IT
        solutions in the new world of IT. Easynet in Business Communication
        provides excellence and quality services to our clients and empowering
        staff through different training and products certifications with our
        business partners. Our goal is to enhance service delivery to our
        clients and become a business partner, not just an IT supplier. We
        believe that through our professionalism as one of our values, Easynet
        in Business Communication will benefit customers, suppliers and
        community.
      </p>
      <div>
        <h2 id="about_headings">Our Vision</h2>

        <p id="info_paragraph">
          To provide new IT updates to our clients and communities especially
          young individuals.
        </p>
        <h2 id="about_headings">Our Mission</h2>

        <p id="info_paragraph">
          To improve the quality of life and provide practical innovative
          products to our customers at competitive pricing.
        </p>
        <h2 id="about_headings">Quality Assurance Statement</h2>

        <p id="info_paragraph">
          To maintain our client base by establishing preferred partnership
          with our clients, retaining and maintaining our high skilled level
          of staff, securing business by selling complete IT solutions.
        </p>
        <h2 id="about_headings">Marketing Mission</h2>
        <p id="info_paragraph">
          To ensure Total Customer Value by delivering on the following
          criteria:
        </p>
        <ul id="market_list">
          <li id="market_list_text" class="animated-item">- Product Quality -</li>
          <li id="market_list_text" class="animated-item">- Competitive pricing -</li>
          <li id="market_list_text" class="animated-item">- On-Time delivery -</li>
          <li id="market_list_text" class="animated-item">- Extensive product knowledge -</li>
          <li id="market_list_text" class="animated-item">- Efficient After-sales service -</li>
          <li id="market_list_text" class="animated-item">- Maintaining and improving customer relationships -</li>
          <li id="market_list_text" class="animated-item">- Leveraging of extensive product range -</li>
        </ul>
      </div>
    </div>
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