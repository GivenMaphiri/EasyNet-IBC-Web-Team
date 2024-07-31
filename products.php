<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyNet IBC | Products</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
  <link href="_styles/font-awesome.css" rel="stylesheet" />
  <link href="_styles/style.css" rel="stylesheet" />
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
    <div id="background_products">
      <h1>Products</h1>
      <h2>Shop the latest in hardware, software and accessories</h3>
    </div>
    <div id="product_head">
      <h1>Shop our products</h1>
    </div>
    <div id="search_bar">
      <input id="searchbar" type="text" placeholder="Search for products...">
      <input id="searchbutton" type="submit" value="Search">
    </div>

    <div id="homeboxes">
      <div id="prodbox1">
        <img src="_images/hardware.png" width="250px" />
        <h3>Hardware</h3>
        <a href="products2.php"><button id="boxbutton">Shop Hardware</button></a>
      </div>
      <div id="prodbox1">
        <img src="_images/adobe.jpg" width="250px" />
        <h3>Software</h3>
        <a href="products2.php"><button id="boxbutton">Shop Software</button></a>
      </div>
      <div id="prodbox1">
        <img src="_images/consumables.webp" width="250px" />
        <h3>Accessories</h3>
        <a href="products2.php"><button id="boxbutton">Shop Accessories</button></a>
      </div>
      <div id="prodbox1">
        <img src="_images/all_products.jpg" width="265px" />
        <h3>All Products</h3>
        <a href="products2.php"><button id="boxbutton">Shop All Products</button></a>
      </div>
    </div>


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