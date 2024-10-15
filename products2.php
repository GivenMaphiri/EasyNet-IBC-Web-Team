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

        // Check if a manufacturer is selected
        $manufacturer = isset($_GET['manufacturer']) ? $_GET['manufacturer'] : '';

        if ($searchQuery) {
          echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; Search Results for '" . htmlspecialchars($searchQuery) . "'</p>";
        } elseif ($manufacturer) {
          echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; " . htmlspecialchars($manufacturer) . " Products</p>";
        } else {
          echo "<p id='prod_back_main'><a href='products.php' id='prod_back'>Products</a> &#9664; $displayCategory Products</p>";
        }
        ?>


    <div id="all_products_head">
      <?php
      if ($searchQuery) {
        echo "<h1>Search Results for '" . htmlspecialchars($searchQuery) . "'</h1>";
      } elseif ($manufacturer) {
        echo "<h1>" . htmlspecialchars($manufacturer) . " Products</h1>";
      } else {
        echo "<h1>$displayCategory Products</h1>";
      }
      ?>



      <div id="search_bar">
        <form method="GET" action="products2.php" id="search_form">
          <select name="sort_by" id="sort_by">
            <option value="">Sort By</option>
            <option value="price_asc" <?php if (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_asc') echo 'selected'; ?>>Price: Low to High</option>
            <option value="price_desc" <?php if (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_desc') echo 'selected'; ?>>Price: High to Low</option>
            <option value="name_asc" <?php if (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_asc') echo 'selected'; ?>>Alphabetical: A-Z</option>
            <option value="name_desc" <?php if (isset($_GET['sort_by']) && $_GET['sort_by'] == 'name_desc') echo 'selected'; ?>>Alphabetical: Z-A</option>
          </select>
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
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $offset = ($page - 1) * $items_per_page;
          $category = isset($_GET['category']) ? $_GET['category'] : 'all';
          $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
          $manufacturer = isset($_GET['manufacturer']) ? $_GET['manufacturer'] : '';
          $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

          // Determine the sort order based on the selected option
          switch ($sort_by) {
            case 'price_asc':
              $order_by = 'prod_price ASC';
              break;
            case 'price_desc':
              $order_by = 'prod_price DESC';
              break;
            case 'name_asc':
              $order_by = 'prod_name ASC';
              break;
            case 'name_desc':
              $order_by = 'prod_name DESC';
              break;
            default:
              $order_by = 'prod_name ASC';  // Default sorting by name A-Z
              break;
          }

          // Base SQL query to select products with LIMIT and OFFSET for pagination
          if (!empty($searchQuery)) {
            // If a search query is present, search by product name, manufacturer, or type
            $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE (prod_name LIKE ? OR prod_manufacturer LIKE ? OR prod_type LIKE ?)";

            // Modify SQL query based on the selected category and manufacturer
            if ($category !== 'all') {
              $sql .= " AND prod_type = ?";
              if (!empty($manufacturer)) {
                $sql .= " AND prod_manufacturer = ?";
                $sql .= " ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $searchParam = "%" . $searchQuery . "%";
                $stmt->bind_param("sssssii", $searchParam, $searchParam, $searchParam, $category, $manufacturer, $items_per_page, $offset);
              } else {
                $sql .= " ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $searchParam = "%" . $searchQuery . "%";
                $stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $category, $items_per_page, $offset);
              }
            } else {
              if (!empty($manufacturer)) {
                $sql .= " AND prod_manufacturer = ?";
                $sql .= " ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $searchParam = "%" . $searchQuery . "%";
                $stmt->bind_param("ssssi", $searchParam, $searchParam, $searchParam, $manufacturer, $items_per_page, $offset);
              } else {
                $sql .= " ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $searchParam = "%" . $searchQuery . "%";
                $stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $items_per_page, $offset);
              }
            }
          } else {
            // If no search query is present, filter by category and manufacturer
            if ($category !== 'all') {
              $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE prod_type = ?";
              if (!empty($manufacturer)) {
                $sql .= " AND prod_manufacturer = ?";
                $sql .= " ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssii", $category, $manufacturer, $items_per_page, $offset);
              } else {
                $sql .= " ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $category, $items_per_page, $offset);
              }
            } else {
              if (!empty($manufacturer)) {
                $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products WHERE prod_manufacturer = ? ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $manufacturer, $items_per_page, $offset);
              } else {
                $sql = "SELECT prod_id, prod_name, prod_price, prod_image FROM products ORDER BY $order_by LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $items_per_page, $offset);
              }
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
              echo "<a href='prodinfo.php?prod_id=" . $prod_id . "'><p class='product_price'><b>R " . $row['prod_price'] . "</b></p></a>";
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
        // Count the total number of items that match the search, category, and manufacturer
        if (!empty($searchQuery)) {
          $sql_total = "SELECT COUNT(*) FROM products WHERE (prod_name LIKE ? OR prod_manufacturer LIKE ? OR prod_type LIKE ?)";

          if ($category !== 'all') {
            $sql_total .= " AND prod_type = ?";
            if (!empty($manufacturer)) {
              $sql_total .= " AND prod_manufacturer = ?";
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("sssss", $searchParam, $searchParam, $searchParam, $category, $manufacturer);
            } else {
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("ssss", $searchParam, $searchParam, $searchParam, $category);
            }
          } else {
            if (!empty($manufacturer)) {
              $sql_total .= " AND prod_manufacturer = ?";
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("ssss", $searchParam, $searchParam, $searchParam, $manufacturer);
            } else {
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("sss", $searchParam, $searchParam, $searchParam);
            }
          }
        } else {
          if ($category !== 'all') {
            $sql_total = "SELECT COUNT(*) FROM products WHERE prod_type = ?";
            if (!empty($manufacturer)) {
              $sql_total .= " AND prod_manufacturer = ?";
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("ss", $category, $manufacturer);
            } else {
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("s", $category);
            }
          } else {
            if (!empty($manufacturer)) {
              $sql_total = "SELECT COUNT(*) FROM products WHERE prod_manufacturer = ?";
              $stmt_total = $conn->prepare($sql_total);
              $stmt_total->bind_param("s", $manufacturer);
            } else {
              $sql_total = "SELECT COUNT(*) FROM products";
              $stmt_total = $conn->prepare($sql_total);
            }
          }
        }

        // Execute the query to get the total number of items
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        $total_items = $result_total->fetch_row()[0];

        // Calculate the total number of pages
        $total_pages = ceil($total_items / $items_per_page);

        // Determine the current page from the query string
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Define the maximum number of pages to display at a time
        $max_pages_to_show = 10;

        // Determine the range of pages to show
        $start_page = max(1, $current_page - floor($max_pages_to_show / 2));
        $end_page = min($total_pages, $start_page + $max_pages_to_show - 1);

        // Adjust the start page if we're close to the end
        if ($end_page - $start_page < $max_pages_to_show - 1) {
          $start_page = max(1, $end_page - $max_pages_to_show + 1);
        }

        // Display pagination links
        echo "<div id='pagination'>";

        // "Previous" link
        if ($current_page > 1) {
          $prev_page = $current_page - 1;
          $url = "products2.php?page=$prev_page";
          if ($category !== 'all') {
            $url .= "&category=$category";
          }
          if (!empty($searchQuery)) {
            $url .= "&search=" . urlencode($searchQuery);
          }
          if (!empty($manufacturer)) {
            $url .= "&manufacturer=" . urlencode($manufacturer);
          }
          echo "<a href='$url'>&laquo; Previous</a> ";
        }

        // Display the range of pages
        for ($i = $start_page; $i <= $end_page; $i++) {
          $url = "products2.php?page=$i";
          if ($category !== 'all') {
            $url .= "&category=$category";
          }
          if (!empty($searchQuery)) {
            $url .= "&search=" . urlencode($searchQuery);
          }
          if (!empty($manufacturer)) {
            $url .= "&manufacturer=" . urlencode($manufacturer);
          }

          // Highlight the current page
          if ($i == $current_page) {
            echo "<strong>$i</strong> ";
          } else {
            echo "<a href='$url'>$i</a> ";
          }
        }

        // "Next" link
        if ($current_page < $total_pages) {
          $next_page = $current_page + 1;
          $url = "products2.php?page=$next_page";
          if ($category !== 'all') {
            $url .= "&category=$category";
          }
          if (!empty($searchQuery)) {
            $url .= "&search=" . urlencode($searchQuery);
          }
          if (!empty($manufacturer)) {
            $url .= "&manufacturer=" . urlencode($manufacturer);
          }
          echo "<a href='$url'>Next &raquo;</a>";
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