<?php
session_start();
include "DBConn.php";
if (!isset($_SESSION['user_id'])) {
  // If the user is not logged in, redirect to the login page or show an appropriate message
  header("Location: login.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="EasyNet: In Business Communications provides IT solutions with various IT services and products." />
  <title>EasyNet IBC | Checkout</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
  <link href="_styles/style.css" rel="stylesheet" />
  <link href="_styles/font-awesome.css" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="_javascript/products.js" async></script>
</head>

<body>

  <!--Start of Header --------------------------->
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
        <a href="checkout.php"><img id="icons_bag" class="active" src="_images/_icons/bag.png" width="30px"></a>
      </div>

      <label for="check" class="menu">
        <i class='bx bx-menu' id="menu_icon"></i>
        <i class='bx bx-x' id="close_icon"></i>
      </label>
    </div>
  </header>

  <!--End of Header --------------------------->

  <main>

    <div id="checkout_heading">
      <h1>Checkout</h1>
    </div>
    <hr id="checkout_lines">

    <?php

    $user_ID = $_SESSION['user_id']; // Retrieve the user ID from the session

    $sql = "SELECT * FROM cart WHERE user_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $subtotal = 0;
    $totalprice = 0;
    $cartvat = 0;

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $subtotal += $row['prod_price'] * $row['quantity'];
        $cartvat += $row['cart_VAT'] * $row['quantity'];
        $totalprice += $row['cart_incTotal'] * $row['quantity'];
        echo "<div id='products_container'>";
        echo "<a href='prodinfo.php?prod_id=" . $row['prod_ID'] . "'><img src='_images/_products/" . $row['prod_image'] . "' width='150px' /></a>";
        echo "<a href='prodinfo.php?prod_id=" . $row['prod_ID'] . "'><p>" . $row['prod_name'] . "</p></a>";
        echo "<p class='prod_prices'><b>R" . number_format($row['prod_price'], 2) . "</b></p>";
        echo "<div id='check_quantity'>";
        echo "<input class='cart_quantity' type='number' value='" . $row['quantity'] . "' data-prod-id='" . $row['prod_ID'] . "' data-price='" . $row['prod_price'] . "' data-price-inc='" . $row['cart_incTotal'] . "' data-price-vat='" . $row['cart_VAT'] . "'>";
        echo "<button id='rem_button' class='btn_danger' onclick='removeFromCart(" . $row['prod_ID'] . ")'>Remove from Cart</button>";
        echo "</div>";
        echo "</div>";
      }
      echo "</div>";
      echo "<div>";
      echo "</div>";
      echo "<div id='total_container'>";
      echo "<h1> Net Price:</h1>";
      echo "<h1 class='cart_total_price'>R" . number_format($subtotal, 2) . "</h1>";
      echo "<h1> VAT Amount:</h1>";
      echo "<h1 class='cart_total_price_vat'>R" . number_format($cartvat, 2) . "</h1>";
      echo "<h1>Total Price:</h1>";
      echo "<h1 class='cart_total_price_inc'>R" . number_format($totalprice, 2) . "</h1>";
      echo "<a href='shipping.php'><button id='checkout_button'>Checkout</button></a>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    } else {
      echo "<h1>Your cart is empty.</h1>";
    }

    $stmt->close();
    $conn->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.cart_quantity').on('change', function() {
          var prod_ID = $(this).data('prod-id');
          var newQuantity = $(this).val();
          var price = $(this).data('price');
          var priceInc = $(this).data('price-inc');
          var priceVat = $(this).data('price-vat');

          $.ajax({
            url: 'update_cart.php',
            method: 'POST',
            data: {
              prod_ID: prod_ID,
              quantity: newQuantity
            },
            success: function(response) {
              var newTotal = price * newQuantity;
              var newTotalInc = priceInc * newQuantity;
              var newTotalVat = priceVat * newQuantity;
              var totalCartPrice = 0;
              var totalCartPriceInc = 0;
              var totalCartPriceVat = 0;

              $('.cart_quantity').each(function() {
                var quantity = $(this).val();
                var itemPrice = $(this).data('price');
                var itemPriceInc = $(this).data('priceInc');
                var itemPriceVat = $(this).data('priceVat');
                totalCartPrice += quantity * itemPrice;
                totalCartPriceInc += quantity * itemPriceInc;
                totalCartPriceVat += quantity * itemPriceVat;
              });
              $('.cart_total_price_vat').text('R' + totalCartPriceVat.toFixed(2));
              $('.cart_total_price').text('R' + totalCartPrice.toFixed(2));
              $('.cart_total_price_inc').text('R' + totalCartPriceInc.toFixed(2));
            }
          });
        });
      });

      function removeFromCart(prod_ID) {
        if (confirm('Are you sure you want to remove this item from the cart?')) {
          // User clicked OK, proceed with the AJAX request
          $.ajax({
            url: 'remove_cart.php',
            method: 'POST',
            data: {
              prod_ID: prod_ID
            },
            success: function(response) {
              location.reload(); // Reload the page to reflect changes in the cart
            }
          });
        } else {
          // User clicked Cancel, do nothing or add any additional handling here if needed
          console.log('Item not removed from the cart.');
        }
      }
    </script>

  </main>

  <!--Start  of Footer --------------------------->
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
  <!--End of Footer --------------------------->
</body>

</html>