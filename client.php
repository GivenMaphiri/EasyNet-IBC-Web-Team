<?php

session_start();
include "DBConn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyNet IBC | Our Clients</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
  <link href="_styles/font-awesome.css" rel="stylesheet" />
  <link href="_styles/style.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

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
            <a href="client.php" id="nav_text" class="active">Partners and Clients</a>
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
    <div id="background_partners">
      <h1>Partners and Clients</h1>
      <h2>Find out more about the partners and clients we work with</h2>
    </div>

    <div id="partner_info">
      <table id="partner_table">
        <thead>
          <tr>
            <th>Our Partners</th>
            <th>Partner Certification</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Pinnacle</td>
            <td>Adobe Partner Certified</td>
          </tr>
          <tr>
            <td>Axiz Workgroup</td>
            <td>Dell Partner Certified</td>
          </tr>
          <tr>
            <td>Tarsus</td>
            <td>HP Partner Certified</td>
          </tr>
          <tr>
            <td>Mustek</td>
            <td>Lenovo Partner Certified</td>
          </tr>
          <tr>
            <td>Drive Control</td>
            <td>Acer Partner Certified</td>
          </tr>
          <tr>
            <td>The Core Group</td>
            <td>Cisco Partner Certified</td>
          </tr>
          <tr>
            <td>Linkage</td>
            <td>Zebra Partner Certified</td>
          </tr>
          <tr>
            <td>Ecoteq</td>
            <td></td>
          </tr>
          <tr>
            <td>Service Parts Logistics</td>
            <td></td>
          </tr>
          <tr>
            <td>Koloq</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="partner_heading">
      <h1 id="partner_head">Find out more about our Partners</h1>
    </div>
    <div id="partner_imgs">
      <a href="adobe.com" title="Adobe.com"><img src="_images/adobe.png" id="partners" width="150px" /></a>
      <a href="https://www.dellonline.co.za/" title="Dellonline.co.za"><img src="_images/_logos/delllogo.png" id="partners" width="150px" /></a>
      <a href="https://www.lenovo.com/za" title="Lenovo.com"><img src="_images/_logos/lenovologo.png" id="partners" width="150px" /></a>
      <a href="https://www.acer.com/za-en" title="Acer.com"><img src="_images/_logos/acerlogo.png" id="partners" width="150px" /></a>
      <a href="https://www.cisco.com/c/en_za/index.html" title="Cisco.com"><img src="_images/_logos/ciscologo.png" id="partners" width="150px" height="48px" /></a>
      <a href="https://www.zebra.com/gb/en.html" title="Zebra.com"><img src="_images/_logos/zebra.png" id="partners" width="150px" /></a>
    </div>
    <br />

    <div id="client_body_bottom" class="table-container">
      <table>
        <thead>
          <tr>
            <th colspan="2" id="client_name_heading">Our Clients</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>City of Tshwane</td>
            <td>City of Joburg</td>
          </tr>
          <tr class="alternate-row">
            <td>Nersa</td>
            <td>Legal Aid SA</td>
          </tr>
          <tr>
            <td>SAHRC</td>
            <td>SANAS</td>
          </tr>
          <tr class="alternate-row">
            <td>CIDB</td>
            <td>NHBRC</td>
          </tr>
          <tr>
            <td>NEMISA</td>
            <td>Mining Qualifications Authority</td>
          </tr>
          <tr class="alternate-row">
            <td>CHIETA</td>
            <td>SAPS</td>
          </tr>
          <tr>
            <td>Dept. of Rural Development</td>
            <td>GGDA</td>
          </tr>
          <tr class="alternate-row">
            <td>Department of Housing</td>
            <td>Department of Treasury</td>
          </tr>
          <tr>
            <td>Office of the Premier</td>
            <td>GPAA</td>
          </tr>
          <tr class="alternate-row">
            <td>Department of Water & Sanitation</td>
            <td>Department of Correctional Services</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div id="client_imgs" class="carousel">
      <div class="carousel-item">
        <img src="_images/_logos/cityofts.png" id="clients" width="100px" />
        <img src="_images/_logos/cityofjo.png" id="clients" width="100px" />
        <img src="_images/_logos/nersa.jpg" id="clients" width="100px" />
        <img src="_images/_logos/legalaid.png" id="clients" width="100px" />
      </div>
      <div class="carousel-item">
        <img src="_images/_logos/sahrc.JPG" id="clients" width="80px" />
        <img src="_images/_logos/sanas.png" id="clients" width="150px" />
        <img src="_images/_logos/cidb.png" id="clients" width="150px" />
        <img src="_images/_logos/nhbrc.png" id="clients" width="100px" />
      </div>
      <div class="carousel-item">
        <img src="_images/_logos/nemisa.png" id="clients" width="150px" />
        <img src="_images/_logos/mining.png" id="clients" width="150px" />
        <img src="_images/_logos/chieta.png" id="clients" width="150px" />
        <img src="_images/_logos/saps.png" id="clients" width="100px" />
      </div>
      <div class="carousel-item">
        <img src="_images/_logos/rural.jpg" id="clients" width="200px" />
        <img src="_images/_logos/ggda.png" id="clients" width="120px" />
        <img src="_images/_logos/correctional.jpeg" id="clients" width="200px" />
        <img src="_images/_logos/treasury.png" id="clients" width="160px" />
      </div>
      <div class="carousel-item">
        <img src="_images/_logos/premier.png" id="clients" width="180px" />
        <img src="_images/_logos/gpaa.jpg" id="clients" width="200px" />
        <img src="_images/_logos/water.png" id="clients" width="200px" />
        <img src="_images/_logos/housing.png" id="clients" width="200px" />
      </div>
    </div>

    </div>
    </div>
  </main>

  <footer>
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
    <hr id="foot_line" />
    <p id="footer_text">
      Copyright &copy; 2024 EasyNet In Business Communications
    </p>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#partner_imgs').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots: true,
          arrows: true,
          responsive: [{
              breakpoint: 900,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });
      });

      $(document).ready(function() {
        $('#client_imgs').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots: true,
          arrows: true,
          responsive: [{
              breakpoint: 900,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });
      });
    </script>
  </footer>
</body>

</html>