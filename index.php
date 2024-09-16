<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="EasyNet: In Business Communications provides IT solutions with various IT services and products." />
  <title>EasyNet IBC | IT Solutions</title>
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

  <body>
    <div id="background_home">
      <h1>EasyNet</h1>
      <h2>In Business Communications</h2>
      <h3>Providing IT solutions in an easy way</h2><br>
        <h2>Shop our wide range of gadgets and equipment</h2><br>
        <a href="products.php"><button>Shop now </button> </a>
    </div>

    <div id="feature_box">
      <h1 id="feature_box_head">Find Something New</h1>
      <p>A varied selection of items that you might need</p>
    </div>

    <section id="features">

      <?php
      // SQL query to select 3 random products from the "Accessories" category
      $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products ORDER BY RAND() LIMIT 4";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $prod_id = $row['prod_id'];
          $prod_img = $row['prod_image'];
          echo "<div id='prodbox2'>";
          echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><img class='prod_image' src='_images/_products/" . $row['prod_image'] . "' width='150px'/></a>";
          echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='prod_title'>" . $row['prod_name'] . "</p></a>";
          echo "<a href='prodinfo.php?prod_id=" . $prod_id . "?'><p class='product_price'><b>R " . $row['prod_price'] . "</b></p></a>";
          echo "<div id='add_heart_buttons'>";
          echo "<button type='button' class='add_to_cart' data-prod-id='" . $row['prod_id'] . "' data-prod-name='" . $row['prod_name'] . "' data-prod-price='" . $row['prod_price'] . "' data-prod-image='$prod_img' id='boxbutton'>Add to Cart</button>";
          echo "<button type='button' class='add_to_favourite' data-prod-id='" . $row['prod_id'] . "' data-prod-name='" . $row['prod_name'] . "' data-prod-price='" . $row['prod_price'] . "' data-prod-image='$prod_img' id='heart_button'><img id='heart_button_img' src='_images/_icons/heart.png' width='18px' /></button>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "<p>No products found.</p>";
      }
      ?>

    </section>



    <section id="deals_banner">
      <h4> Combos</h4>
      <h2>Explore our - <span> EXCLUSIVE COMBO </span> - deals</h2>
      <button>Explore More</button>
    </section>

    <div id="feature_box">
      <h1 id="feature_box_head">Featured Items</h1>
      <p>View our most purchased items</p>
    </div>
    <section id="features">
      <div id="fea-container">
        <div id="fea">
          <img src="_images/microsoft_365.webp" width="200px">
        </div>
        <h6>Microsoft</h6>
        <h4>Microsoft 365</h4>
        <h5>R1 200</h5>
        <div id="star">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/half-filled-rating-star.png" width="15px">
          <img src="_images/_icons/empty-rating.png" width="15px">
        </div>
        <a href="products2.php">
          <button id="boxbutton-home">Add to Cart</button></a>
      </div>

      <div id="fea-container">
        <div id="fea">
          <img src="_images/macbook_13.webp" width="200px">
        </div>
        <h6>Apple</h6>
        <h4>Apple MacBook Air 13-Inch With M1 Processor</h4>
        <h5>R15 999</h5>
        <div id="star">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/half-filled-rating-star.png" width="15px">
          <img src="_images/_icons/empty-rating.png" width="15px">
        </div>
        <a href="products2.php">
          <button id="boxbutton-home">Add to Cart</button></a>
      </div>

      <div id="fea-container">
        <div id="fea">
          <img src="_images/ipad_13inch.webp" width="200px">
        </div>
        <h6>Apple</h6>
        <h4>Apple iPad Pro 13inch M4 WiFi 256GB Standard Glass Space Black</h4>
        <h5>R15 999</h5>
        <div id="star">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
        </div>
        <a href="products2.php">
          <button id="boxbutton-home">Add to Cart</button></a>
      </div>

      <div id="fea-container">
        <div id="fea">
          <img src="_images/playstation_controller.webp" width="250px">
        </div>
        <h6>PlayStation</h6>
        <h4>Playstation 5 DualSense EDGE Wireless Controller</h4>
        <h5>R4 599</h5>
        <div id="star">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/full-filled-rating.png" width="15px">
          <img src="_images/_icons/half-filled-rating-star.png" width="15px">
        </div>
        <a href="products2.php">
          <button id="boxbutton-home">Add to Cart</button></a>
      </div>
    </section>

    <div id="home_box">
      <h1 id="home_box_head">Shop our products</h1>
    </div>
    <div id="homeboxes">
      <div id="prodbox5">
        <img src="_images/hardware.png" width="250px" />
        <h3>Hardware</h3>
        <a href="products2.php?category=Hardware"><button id="boxbutton">Shop Hardware</button></a>
      </div>
      <div id="prodbox5">
        <img src="_images/adobe.jpg" width="250px" />
        <h3>Software</h3>
        <a href="products2.php?category=Software"><button id="boxbutton">Shop Software</button></a>
      </div>
      <div id="prodbox5">
        <img src="_images/consumables.webp" width="250px" />
        <h3>Accessories</h3>
        <a href="products2.php?category=Accessories"><button id="boxbutton">Shop Accessories</button></a>
      </div>
      <div id="prodbox5">
        <img src="_images/all_products.jpg" width="265px" />
        <h3>All Products</h3>
        <a href="products2.php?category=all"><button id="boxbutton">Shop All Products</button></a>
      </div>
    </div>


    <section id="bottom_banners">
      <div class="info_banner1">
        <h2>Find Out More About Us</h2>
        <p>Find out more about what we do and how we can assist you.
          </br>
          <a href="about.php" id="paragraph_link">About Us ></a>
        </p>
      </div>

      <div class="info_banner2">
        <h2>Products and Services</h2>
        <p>Check out our various IT products and services.</p></br>
        <a href="products.php" id="paragraph_link">Products and Services ></a>
      </div>

      <div class="info_banner3">
        <h2>Our Partners and Clients</h2>
        <p>Check out our Partners and Clients that we currently work with.</br>
          <a href="client.php" id="paragraph_link">Partners and Clients ></a>
        </p>
      </div>

      <div class="info_banner4">
        <h2>Talk to Us</h2>
        <p>Find out how you can contact us.
          </br>
          <a href="contact.php" id="paragraph_link">Contact Us ></a>
        </p>
      </div>
    </section>
    <script src="_javascript/index.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.add_to_cart').on('click', function(e) {
          e.preventDefault();
          var prod_ID = $(this).data('prod-id');
          var prod_name = $(this).data('prod-name');
          var prod_price = $(this).data('prod-price');
          var prod_image = $(this).data('prod-image');

          $.ajax({
            url: 'addtocart.php',
            method: 'POST',
            data: {
              add_to_cart: true,
              prod_ID: prod_ID,
              prod_name: prod_name,
              prod_price: prod_price,
              prod_image: prod_image
            },
            success: function(response) {
              var result = JSON.parse(response);
              if (result.status === 'success') {
                alert('Product added to cart!');
              } else {
                alert('There was an issue adding the product to the cart.');
              }
            }
          });
        });
      });

      // Add to Favourite button click event
      $(document).on('click', '.add_to_favourite', function() {
        var prodId = $(this).data('prod-id');
        var prodName = $(this).data('prod-name');
        var prodPrice = $(this).data('prod-price');
        var prodImage = $(this).data('prod-image');

        $.ajax({
          url: 'addtofavourite.php', // Ensure this is the correct path to your PHP file
          method: 'POST',
          data: {
            prod_id: prodId,
            prod_name: prodName,
            prod_price: prodPrice,
            prod_image: prodImage
          },
          success: function(response) {
            alert(response); // Display the server response for debugging
            if (response == 'success') {
              alert('Product added to favourites!');
            } else {
              alert('Failed to add to favourites.');
            }
          },
          error: function(xhr, status, error) {
            console.log(error); // Log any errors to the console
            alert('Failed to add to favourites.');
          }
        });
      });
    </script>
  </body>

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