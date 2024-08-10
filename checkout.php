<?php
session_start();
include "DBConn.php";

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
                  <h4><a href="products2.php">Hardware</a></h4>
                  <ul class="mega-link">
                    <li>Servers</li>
                    <li>Desktops</li>
                    <li>Monitors</li>
                    <li>Fax Machines</li>
                    <li>Computer Components</li>
                    <li>Projectors</li>
                  </ul>
                </div>
                <div class="row">
                  <h4><a href="products2.php">Software</a></h4>
                  <ul class="mega-link">
                    <li>Microsoft</li>
                    <li>Symantec</li>
                    <li>CorelDraw</li>
                    <li>Adobe</li>
                  </ul>
                </div>
                <div class="row">
                  <h4><a href="products2.php">Accessories</a></h4>
                  <ul class="mega-link">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                  </ul>
                </div>
                <div class="row">
                  <h4><a href="products2.php">Combos</a></h4>
                  <ul class="mega-link">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                  </ul>
                </div>
                <div class="row">
                  <h4><a href="products2.php">All</a></h4>
                  <ul class="mega-link">
                    <li>Asus</li>
                    <li>Acer</li>
                    <li>Apple</li>
                    <li>Dell</li>
                    <li>Hisense</li>
                    <li>Hp</li>
                    <li>Lenovo</li>
                    <li>Microsoft</li>
                    <li>Samsung</li>
                  </ul>
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

    <div class="checkout">

      <div class="checkout_heading">
        <h1>Checkout</h1>
      </div>
      <hr id="checkout_lines">

    </div>

    <div class="checkout_boxes">
      <?php

      $user_ID = 1;
      $sql = "SELECT * FROM cart WHERE user_ID = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $user_ID);
      $stmt->execute();
      $result = $stmt->get_result();

      $totalPrice = 0;

      if ($result->num_rows > 0) {


        while ($row = $result->fetch_assoc()) {
          $subtotal = $row['prod_price'] * $row['quantity'];
          $totalPrice += $subtotal;
          echo "<div id='cart_items'>";
          echo "<div class='checkbox1'>";
          echo "<a href='prodinfo.php?prod_ID=" . $row['prod_ID'] . "'><img src='_images/_products/" . $row['prod_image'] . "' width='200px' /></a>";
          echo "<a href='prodinfo.php?prod_ID=" . $row['prod_ID'] . "'><p>" . $row['prod_name'] . "</p></a>";
          echo "<p class='prod_prices'><b>R" . number_format($row['prod_price'], 2) . "</b></p>";
          echo "<div id='check_quantity'>";
          echo "<input class='cart_quantity' type='number' value='" . $row['quantity'] . "' data-prod-id='" . $row['prod_ID'] . "' data-price='" . $row['prod_price'] . "'>";
          echo "<button class='btn_danger' onclick='removeFromCart(" . $row['prod_ID'] . ")'>Remove from Cart</button>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }



        echo "<div id='total_price'>";
        echo "<h1>Total Price:</h1>";
        echo "<h1 class='cart_total_price'>R" . number_format($totalPrice, 2) . "</h1>";
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

            $.ajax({
              url: 'update_cart.php',
              method: 'POST',
              data: {
                prod_ID: prod_ID,
                quantity: newQuantity
              },
              success: function(response) {
                var newTotal = price * newQuantity;
                var totalCartPrice = 0;

                $('.cart_quantity').each(function() {
                  var quantity = $(this).val();
                  var itemPrice = $(this).data('price');
                  totalCartPrice += quantity * itemPrice;
                });

                $('.cart_total_price').text('R' + totalCartPrice.toFixed(2));
              }
            });
          });
        });

        function removeFromCart(prod_ID) {
          if (confirm('Are you sure you want to remove this item from the cart?')) {
            $.ajax({
              url: 'remove_cart.php',
              method: 'POST',
              data: {
                prod_ID: prod_ID
              },
              success: function(response) {
                location.reload();
              }
            });
          }
        }
      </script>

  </main>

  <!--Start  of Footer --------------------------->
  <footer id="contact_footer">
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
  </footer>
  <!--End of Footer --------------------------->
</body>

</html>