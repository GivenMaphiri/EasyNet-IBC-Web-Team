<?php

session_start();
include "DBConn.php";
if (isset($_SESSION['login_required']) && $_SESSION['login_required'] === true) {
  echo "<script>alert('You must be logged in to add items to the cart.');</script>";
  unset($_SESSION['login_required']); // Unset the session variable after showing the alert
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyNet IBC | Products</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
  <link href="_styles/font-awesome.css" rel="stylesheet" />
  <link href="_styles/style.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <script src="_javascript/products.js" async></script>
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
            <a href="products.php" id="nav_text" class="active">Products</a>
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
                    <li>Printer Cartridge</li>
                    <li>Headsets</li>
                    <li>Controllers</li>
                  </ul>
                </div>
                <div class="row">
                  <h4><a href="products2.php">Combos</a></h4>
                  <ul class="mega-link">
                    <li>Gaming</li>
                    <li>Keyboard and Mouse</li>
                    <li>Sound System</li>
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
        <div class="icon_cart">
          <a href="checkout.php"><img id="icons_bag" src="_images/_icons/bag.png" width="30px" /></a>
        </div>
      </div>
      <label for="check" class="menu">
        <i class="bx bx-menu" id="menu_icon"></i>
        <i class="bx bx-x" id="close_icon"></i>
      </label>
    </div>
  </header>

  <main><?php
        // Retrieve the category from the URL parameter, defaulting to 'all' if not set
        $category = isset($_GET['category']) ? $_GET['category'] : 'all';

        // Map category values to display names
        $categoryNames = [
          'Hardware' => 'Hardware',
          'Software' => 'Software',
          'Accessories' => 'Accessories',
          'all' => 'All'
        ];

        // Determine the display name of the category
        $displayCategory = isset($categoryNames[$category]) ? $categoryNames[$category] : 'All Products';

        echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; $displayCategory Products</p>";
        ?>

    <div id="all_products_head">
      <?php
      // Retrieve the category from the URL parameter, defaulting to 'all' if not set
      $category = isset($_GET['category']) ? $_GET['category'] : 'all';

      // Map category values to display names
      $categoryNames = [
        'Hardware' => 'Hardware',
        'Software' => 'Software',
        'Accessories' => 'Accessories',
        'all' => 'All'
      ];

      // Determine the display name of the category
      $displayCategory = isset($categoryNames[$category]) ? $categoryNames[$category] : 'All Products';

      echo "<h1>$displayCategory Products</h1>";
      ?>
      <div id="prod_left">
        <ul>
          <li>Sort By:</li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <li>Type:</li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <li>Manufacturer:</li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <li>Price:</li>
        </ul>
      </div>
      <div id="search_bar">
        <input id="searchbar" type="text" placeholder="Search for products..." />
        <input id="searchbutton" type="submit" value="Search" />
      </div>
    </div>

    <div id="product_mainpage">
      <div id="prod_right">
        <div class="prod_display">
          <?php

          // Retrieve the category from the URL parameter, defaulting to 'all' if not set
          $category = isset($_GET['category']) ? $_GET['category'] : 'all';

          // Base SQL query to select products
          $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products";

          // Modify SQL query based on the selected category
          if ($category !== 'all') {
            $sql .= " WHERE prod_type = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();
          } else {
            $result = $conn->query($sql);
          }

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
              echo "<button id='heart_button'><img id='heart_button_img' src='_images/_icons/heart.png' width='18px' /></button>";
              echo "</div>";
              echo "</div>";
            }
          } else {
            echo "<p>No products found in this category.</p>";
          }

          // Close the statement if prepared
          if (isset($stmt)) {
            $stmt->close();
          }

          // Close the database connection
          $conn->close();

          ?>

        </div>
      </div>
    </div>
    <!-- Add this script in the HTML file where the "Add to Cart" button is present -->
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
    </script>

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
  </footer>
</body>

</html>