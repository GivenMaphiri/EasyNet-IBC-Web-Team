<?php
session_start();
include "DBConn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="We specialise in providing IT solutions to all businesses" />
  <title>EasyNet IBC | About Us</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
  <link href="_styles/style.css" rel="stylesheet" />
  <link href="_styles/font-awesome.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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
            <a href="about.php" id="nav_text" class="active">About Us</a>
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
    <div id="background_about">
      <h1>About Us</h1>
      <h2>Find out more about what we do</h2>
    </div>
    <div id="about_paragraph">
      <p id="about_description">
        Easynet in Business Communication is a women owned IT Company, founded
        in 2007, intent on developing and delivering market driven IT
        solutions in the new world of IT. Easynet in Business Communication
        provides excellence and quality services to our clients and empowering
        staff through different training and products certifications with our
        business partners. Our goal is to enhance service delivery to our
        clients and become a business partner, not just an IT supplier. We
        believe that through our professionalism as one of our values, Easynet
        in Business Communication will benefit customers, suppliers and
        community.
      </p>
      <div>
        <h2 id="about_headings">Our Vision</h2>

        <p id="info_paragraph">
          To provide new IT updates to our clients and communities especially
          young individuals.
        </p>
        <h2 id="about_headings">Our Mission</h2>

        <p id="info_paragraph">
          To improve the quality of life and provide practical innovative
          products to our customers at competitive pricing.
        </p>
        <h2 id="about_headings">Quality Assurance Statement</h2>

        <p id="info_paragraph">
          To maintain our client base by establishing preferred partnership
          with our clients, retaining and maintaining our high skilled level
          of staff, securing business by selling complete IT solutions.
        </p>
        <h2 id="about_headings">Marketing Mission</h2>
        <p id="info_paragraph">
          To ensure Total Customer Value by delivering on the following
          criteria:
        </p>
        <ul id="market_list">
          <li id="market_list_text" class="animated-item">- Product Quality -</li>
          <li id="market_list_text" class="animated-item">- Competitive pricing -</li>
          <li id="market_list_text" class="animated-item">- On-Time delivery -</li>
          <li id="market_list_text" class="animated-item">- Extensive product knowledge -</li>
          <li id="market_list_text" class="animated-item">- Efficient After-sales service -</li>
          <li id="market_list_text" class="animated-item">- Maintaining and improving customer relationships -</li>
          <li id="market_list_text" class="animated-item">- Leveraging of extensive product range -</li>
        </ul>
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