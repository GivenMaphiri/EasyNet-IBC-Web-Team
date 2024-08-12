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

            $sql = "SELECT prod_price FROM products WHERE prod_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $prod_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<h1>R " . $row['prod_price'] . "</h3>";
              }
            } else {
              echo "<p>Product not found.</p>";
            }
          }

          echo "<button id='addfavourite'>Add to Favourites</button>";
          echo "<button id='boxbutton'>Add to Cart</button>";
          ?>
        </div>
      </div>

    </div>

    <div id="add_more">
      <h1>Add More to your Order</h1>
      <div id="prod_display2">
        <?php

        $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE prod_type = 'Accessories'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {
            $prod_id = $row['prod_id'];
            echo "<div id='prodbox3'>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><img class='prod_image' src='_images/_products/" . $row['prod_image'] . "' width='150px'/></a>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='prod_title'>" . $row['prod_name'] . "</p></a>";
            echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='product_price'><b>R " . $row['prod_price'] . "</b></p></a>";
            echo "<div id='add_heart_buttons'>";
            echo "<button id='boxbutton' class='add_to_cart'>Add to Cart</button>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<p>No books added yet.</p>";
        }

        ?>
        <div id="prodbox3">
          <a href="prodinfo.php"><img id="hard_img" src="_images/_products/hardprod.jpg" width="150px" /></a>
          <a href="prodinfo.php">
            <p>
              HP Pavilion 15 Intel® Core™ i7-1255U 16GB RAM 512GB SSD
              Storage Laptop
            </p>
          </a>
          <p><b>R 19,999</b></p>
          <a href="products2.php"><button id="boxbutton">Add to Cart</button></a>
        </div>
        <div id="prodbox3">
          <a href="prodinfo.php"><img id="hard_img" src="_images/_products/hardprod.jpg" /></a>
          <a href="prodinfo.php">
            <p>
              HP Pavilion 15 Intel® Core™ i7-1255U 16GB RAM 512GB SSD
              Storage Laptop
            </p>
          </a>
          <p><b>R 19,999</b></p>
          <a href="products2.php"><button id="boxbutton">Add to Cart</button></a>
        </div>
      </div>
    </div>

    <div id="add_more">
      <h1>More products by HP</h1>
      <div id="prod_display2">
        <div id="prodbox3">
          <a href="prodinfo.php"><img src="_images/_products/hardprod.jpg" width="150px" /></a>
          <a href="prodinfo.php">
            <p>
              HP Pavilion 15 Intel® Core™ i7-1255U 16GB RAM 512GB SSD
              Storage Laptop
            </p>
          </a>
          <p><b>R 19,999</b></p>
          <a href="products2.php"><button id="boxbutton">Add to Cart</button></a>
        </div>
        <div id="prodbox3">
          <a href="prodinfo.php"><img src="_images/_products/hardprod.jpg" width="150px" /></a>
          <a href="prodinfo.php">
            <p>
              HP Pavilion 15 Intel® Core™ i7-1255U 16GB RAM 512GB SSD
              Storage Laptop
            </p>
          </a>
          <p><b>R 19,999</b></p>
          <a href="products2.php"><button id="boxbutton">Add to Cart</button></a>
        </div>
        <div id="prodbox3">
          <a href="prodinfo.php"><img src="_images/_products/hardprod.jpg" width="150px" /></a>
          <a href="prodinfo.php">
            <p>
              HP Pavilion 15 Intel® Core™ i7-1255U 16GB RAM 512GB SSD
              Storage Laptop
            </p>
          </a>
          <p><b>R 19,999</b></p>
          <a href="products2.php"><button id="boxbutton">Add to Cart</button></a>
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
  </footer>
</body>

</html>