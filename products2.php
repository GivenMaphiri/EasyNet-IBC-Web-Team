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

        // Check if a search query exists
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

        if ($searchQuery) {
          echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; Search Results for '" . htmlspecialchars($searchQuery) . "'</p>";
        } else {
          echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; $displayCategory Products</p>";
        }
        ?>

    <div id="all_products_head">
      <?php
      if ($searchQuery) {
        echo "<h1>Search Results for '" . htmlspecialchars($searchQuery) . "'</h1>";
      } else {
        echo "<h1>$displayCategory Products</h1>";
      }
      ?>

      <div id="search_bar">
        <form method="GET" action="products2.php">
          <input id="searchbar" type="text" name="search" placeholder="Search for products..." value="<?php echo htmlspecialchars($searchQuery); ?>" />
          <input id="searchbutton" type="submit" value="Search" />
        </form>
      </div>
    </div>


    <div id="product_mainpage">
      <div id="prod_right">
        <div class="prod_display">
          <?php

          $items_per_page = 12;

          // Get the current page number from the URL. If not set, default to page 1.
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

          // Calculate the offset for the SQL query
          $offset = ($page - 1) * $items_per_page;

          // Retrieve the category from the URL parameter, defaulting to 'all' if not set
          $category = isset($_GET['category']) ? $_GET['category'] : 'all';

          // Get the search query from the URL, if present
          $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

          // Base SQL query to select products with LIMIT and OFFSET for pagination
          if (!empty($searchQuery)) {
            // If a search query is present, search by product name, manufacturer, or type
            $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE (prod_name LIKE ? OR prod_manufacturer LIKE ? OR prod_type LIKE ?)";

            // Modify SQL query based on the selected category
            if ($category !== 'all') {
              $sql .= " AND prod_type = ? LIMIT ? OFFSET ?";
              $stmt = $conn->prepare($sql);
              $searchParam = "%" . $searchQuery . "%";
              // Corrected bind_param to include the proper number of variables
              $stmt->bind_param("sssiii", $searchParam, $searchParam, $searchParam, $category, $items_per_page, $offset);
            } else {
              $sql .= " LIMIT ? OFFSET ?";
              $stmt = $conn->prepare($sql);
              $searchParam = "%" . $searchQuery . "%";
              // Corrected bind_param to include the proper number of variables
              $stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $items_per_page, $offset);
            }
          } else {
            if ($category !== 'all') {
              $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE prod_type = ? LIMIT ? OFFSET ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sii", $category, $items_per_page, $offset);
            } else {
              $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products LIMIT ? OFFSET ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ii", $items_per_page, $offset);
            }
          }

          // Execute the query
          $stmt->execute();
          $result = $stmt->get_result();

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
            echo "<p>No products found in this category.</p>";
          }
          ?>
        </div>
        <?php
        // Count the total number of items that match the search and/or category
        if (!empty($searchQuery)) {
          $sql_total = "SELECT COUNT(*) FROM products WHERE (prod_name LIKE ? OR prod_manufacturer LIKE ? OR prod_type LIKE ?)";

          if ($category !== 'all') {
            $sql_total .= " AND prod_type = ?";
            $stmt_total = $conn->prepare($sql_total);
            $stmt_total->bind_param("ssss", $searchParam, $searchParam, $searchParam, $category);
          } else {
            $stmt_total = $conn->prepare($sql_total);
            $stmt_total->bind_param("sss", $searchParam, $searchParam, $searchParam);
          }
        } else {
          if ($category !== 'all') {
            $sql_total = "SELECT COUNT(*) FROM products WHERE prod_type = ?";
            $stmt_total = $conn->prepare($sql_total);
            $stmt_total->bind_param("s", $category);
          } else {
            $sql_total = "SELECT COUNT(*) FROM products";
            $stmt_total = $conn->prepare($sql_total);
          }
        }

        // Execute the query to get the total number of items
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        $total_items = $result_total->fetch_row()[0];

        // Calculate the total number of pages
        $total_pages = ceil($total_items / $items_per_page);

        // Display pagination links
        echo "<div id='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
          // Create pagination links including the category and search query if present
          $url = "products2.php?page=$i";
          if ($category !== 'all') {
            $url .= "&category=$category";
          }
          if (!empty($searchQuery)) {
            $url .= "&search=" . urlencode($searchQuery);
          }
          echo "<a href='$url'>$i</a> ";
        }
        echo "</div>";

        // Close the statement if prepared
        $stmt->close();
        $stmt_total->close();

        // Close the database connection
        $conn->close();
        ?>

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

      $(document).ready(function() {
        $('.add_to_favourite').on('click', function(e) {
          e.preventDefault();

          var prod_ID = $(this).data('prod-id');
          var prod_name = $(this).data('prod-name');
          var prod_price = $(this).data('prod-price');
          var prod_image = $(this).data('prod-image');

          $.ajax({
            url: 'addtofavourite.php',
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
                alert('Product added to favourites!');
              } else {
                alert('There was an issue adding the product to favourites.');
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