<?php
session_start();
include "DBConn.php";

if (!isset($_GET['prod_id']) || empty($_GET['prod_id'])) {
  // Redirect to products2.php if prod_ID is not set or is empty
  header("Location: products2.php");
  exit(); // Stop further execution to ensure redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyNet IBC | Products</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
  <link href="_styles/style.css" rel="stylesheet" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="_javascript/products.js" async></script>
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
            <a href="products.php" id="nav_text" class="active">Products</a>
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
        <i class="bx bx-menu" id="menu_icon"></i>
        <i class="bx bx-x" id="close_icon"></i>
      </label>
    </div>
  </header>
  
  <main>
    <?php

    if (isset($_GET['prod_id'])) {
      $prod_id = $_GET['prod_id'];

      $sql = "SELECT prod_name, prod_type FROM products WHERE prod_ID = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $prod_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; <a href='products2.php?category=" . $row['prod_type'] . "' id='prod_back'>" . $row['prod_type'] . " Products</a>&#9664; " . $row['prod_name'] . "</p>";
        }
      } else {
        echo "<p>Product not found.</p>";
      }
    }

    ?>
    <hr id="prod_line">

    <div id="prod_info_section">
      <div id="prod_img">
        <?php
        if (isset($_GET['prod_id'])) {
          $prod_id = $_GET['prod_id'];

          $sql = "SELECT prod_image FROM products WHERE prod_ID = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $prod_id);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<img src='_images/_products/" . $row['prod_image'] . "'width='250px'>";
            }
          } else {
            echo "<p>Product not found.</p>";
          }
        }
        ?>
      </div>
      <div id="prod_info_bottom">
        <div id="prod_info">
          <div id="info_top">
            <?php
            if (isset($_GET['prod_id'])) {
              $prod_id = $_GET['prod_id'];

              $sql = "SELECT prod_name, prod_manufacturer, prod_code, prod_price, prod_description, prod_image FROM products WHERE prod_ID = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $prod_id);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $product_description = $row['prod_description'];
                  $description_array = explode(',', $product_description);
                  echo "<h3 id='prod_name'>" . $row['prod_name'] . "</h3>";
                  echo "<a href=''><p>" . $row['prod_manufacturer'] . "</p></a>";
                  echo "<p id='prod_code'>Product Code: " . $row['prod_code'] . "</p><br>";
                  echo "<ul>";
                  foreach ($description_array as $feature) {
                    echo "<li>" . trim($feature) . "</li>";
                  }
                  echo "</ul>";
                  
                }
              } else {
                echo "<p>Product not found.</p>";
              }

            
            }
            ?>
          </div>
        </div>

        <div id="prod_price">
          <?php
          if (isset($_GET['prod_id'])) {
            $prod_id = $_GET['prod_id'];

            $sql = "SELECT prod_name, prod_price, prod_image FROM products WHERE prod_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $prod_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $prod_name = $row['prod_name'];
                $prod_price = $row['prod_price'];
                $prod_img = $row['prod_image'];
                echo "<h1>R " . $row['prod_price'] . "</h1>";
                echo "<button type='button' class='add_to_favourite' data-prod-id='" . $prod_id . "' data-prod-name='" . $prod_name . "' data-prod-price='" . $prod_price . "' data-prod-image='$prod_img' id='addfavourite'>Add to Favourites</button>";
                echo "<button type='button' class='add_to_cart' data-prod-id='" . $prod_id . "' data-prod-name='" . $prod_name . "' data-prod-price='" . $prod_price . "' data-prod-image='$prod_img' id='boxbutton'>Add to Cart</button>";
              }
            } else {
              echo "<p>Product not found.</p>";
            }

              echo "</br>";
              echo "<div id='warrenty'>";
              echo "<h3>Warrenty Policy</h3>";
              echo "<p>Thank you for shopping with us! We strive to provide you with the highest quality products and exceptional customer service. Below are the details of our warranty and return policy for all products:</p>";
              echo "</br>";
              echo "<ul>";
              echo "<li><b> 3-Year Onsite Warranty</b>: All products come with a comprehensive 3-year onsite warranty, covering any manufacturing defects during normal use. Our dedicated support team is here to assist you with any issues that may arise.</li>";
              echo "<li><b>7-Day Return Policy</b>: If you are not completely satisfied with your purchase, you have 7 days from the date of delivery to return the product. You can opt for a replacement, ensuring you receive the best product for your needs.</li>";
              echo "<li><b>Replacement Process</b>: Should you choose a replacement, please note that it may take 7-14 days for processing and shipment. We appreciate your patience as we work to fulfill your request.</li>";
              echo "<li><b>Return Conditions</b>: To initiate a return, items must be unused and in their original packaging. Please ensure that all accessories, documentation, and packaging materials are included prior to collection.</li>";
              echo "<li><b>Shipping Time</b>: Once your return is processed, please allow 3-4 weeks for shipping, depending on stock availability. We will keep you updated throughout the process.</li>";
              echo "</ul>";
              echo "</br>";
              echo "<p>If you have any questions, please feel free to enquire via our Contact Us page.</p>";
              echo "</div>";
          }
          ?>

        </div>

      </div>
         
    </div>

    <!-- <div class="warrenty">
      <h3>Warrenty Policy</h3>
        <p>Thank you for shopping with us! We strive to provide you with the highest quality products and exceptional customer service. Below are the details of our warranty and return policy for all products:</p>
          <ul>
            <li> 3-Year Onsite Warranty: All products come with a comprehensive 3-year onsite warranty, covering any manufacturing defects during normal use. Our dedicated support team is here to assist you with any issues that may arise.</li>
            <li> 7-Day Return Policy: If you are not completely satisfied with your purchase, you have 7 days from the date of delivery to return the product. You can opt for a replacement, ensuring you receive the best product for your needs.</li>
            <li> Replacement Process: Should you choose a replacement, please note that it may take 7-14 days for processing and shipment. We appreciate your patience as we work to fulfill your request.</li>
            <li> Return Conditions: To initiate a return, items must be unused and in their original packaging. Please ensure that all accessories, documentation, and packaging materials are included prior to collection.</li>
            <li> Shipping Time: Once your return is processed, please allow 3-4 weeks for shipping, depending on stock availability. We will keep you updated throughout the process.</li>
            </ul>
        <p>If you have any questions or require assistance, please feel free to contact our customer support team. We appreciate your business and look forward to serving you!</p>
    </div>
         -->
    <div id="add_more">
      <h1>Add More to your Order</h1>
      <div id="prod_display2">
        <?php
        // SQL query to select 3 random products from the "Accessories" category
        $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE prod_type = 'Accessories' ORDER BY RAND() LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $prod_id = $row['prod_id'];
            echo "<div id='prodbox3'>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><img class='prod_image' src='_images/_products/" . $row['prod_image'] . "' width='150px'/></a>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='prod_title'>" . $row['prod_name'] . "</p></a>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='product_price'><b>R " . $row['prod_price'] . "</b></p></a>";
            echo "<div id='add_heart_buttons'>";
            echo "<button type='button' class='add_to_cart' data-prod-id='" . $row['prod_id'] . "' data-prod-name='" . $row['prod_name'] . "' data-prod-price='" . $row['prod_price'] . "' data-prod-image='" . $row['prod_image'] . "' id='boxbutton'>Add to Cart</button>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<p>No products found.</p>";
        }
        ?>
      </div>
    </div>

    <div id="add_more">
      <?php
      // Check if prod_id is passed in the URL
      $prod_manufacturer = '';
      $products = [];

      // Establish database connection here if not already done

      if (isset($_GET['prod_id'])) {
        $prod_id = $_GET['prod_id'];

        // First, get the manufacturer of the selected product
        $sql = "SELECT prod_manufacturer FROM products WHERE prod_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $prod_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $prod_manufacturer = $row['prod_manufacturer'];

          // Now, retrieve other products from the same manufacturer (excluding the current product)
          $sql2 = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE prod_manufacturer = ? AND prod_id != ? LIMIT 3";
          $stmt2 = $conn->prepare($sql2);
          $stmt2->bind_param("si", $prod_manufacturer, $prod_id);
          $stmt2->execute();
          $result2 = $stmt2->get_result();

          if ($result2->num_rows > 0) {
            $products = $result2->fetch_all(MYSQLI_ASSOC);
          }
        }

        $stmt->close();
        $stmt2->close();
      }

      $conn->close();
      ?>

      <h1>More products by <?php echo htmlspecialchars($prod_manufacturer); ?></h1>
      <div id="prod_display2">
        <?php
        if (!empty($products)) {
          foreach ($products as $product) {
            $prod_id = $product['prod_id'];
            echo "<div id='prodbox3'>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><img class='prod_image' src='_images/_products/" . $product['prod_image'] . "' width='150px'/></a>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='prod_title'>" . htmlspecialchars($product['prod_name']) . "</p></a>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='product_price'><b>R " . htmlspecialchars($product['prod_price']) . "</b></p></a>";
            echo "<div id='add_heart_buttons'>";
            echo "<button type='button' class='add_to_cart' data-prod-id='" . $product['prod_id'] . "' data-prod-name='" . htmlspecialchars($product['prod_name']) . "' data-prod-price='" . htmlspecialchars($product['prod_price']) . "' data-prod-image='" . htmlspecialchars($product['prod_image']) . "' id='boxbutton'>Add to Cart</button>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<p>No other products found from this manufacturer.</p>";
        }
        ?>
      </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).on('click', '.add_to_cart', function() {
        var prodId = $(this).data('prod-id');
        var prodName = $(this).data('prod-name');
        var prodPrice = $(this).data('prod-price');
        var prodImage = $(this).data('prod-image');

        $.ajax({
          url: 'addtocart.php', // Ensure this is the correct path to your PHP file
          method: 'POST',
          data: {
            prod_ID: prodId,
            prod_name: prodName,
            prod_price: prodPrice,
            prod_image: prodImage
          },
          success: function(response) {
            alert(response); // Display the server response for debugging
            if (response == 'success') {

            } else {

            }
          },
          error: function(xhr, status, error) {
            console.log(error); // Log any errors to the console
            alert('Failed to add to favourites.');
          }
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
            if (response == 'success') {} else {}
          },
          error: function(xhr, status, error) {
            console.log(error); // Log any errors to the console

          }
        });
      });
    </script>
  </main>
  <footer>
    <hr id="foot_line" />
    <div class="content">
      <div class="box">
        <img src="_images/_logos/easynet.png">
      </div>

      <div class="box">
        <h3>My Account</h3>
        <a href="manageaccount.php" id="footer_links"> <i class="bx bx-chevron-right"></i>My account </a>
        <a href="manageaccount.php" id="footer_links"> <i class="bx bx-chevron-right"></i>Order history </a>
        <a href="favourites.php" id="footer_links"> <i class="bx bx-chevron-right"></i>Wishlist </a>
      </div>

      <div class="box">
        <h3>Categories</h3>
        <a href="products2.php?category=Hardware" id="footer_links"> <i class="bx bx-chevron-right"></i>Hardware </a>
        <a href="products2.php?category=Software" id="footer_links"> <i class="bx bx-chevron-right"></i>Software </a>
        <a href="products2.php?category=Accessories" id="footer_links"> <i class="bx bx-chevron-right"></i>Accessories</a>
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