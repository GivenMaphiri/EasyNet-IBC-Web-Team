<?php
// Check connection
session_start(); // Start the session
include "DBConn.php"; // Include your database connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyNet Dashboard Messages</title>
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="stylesheet" href="_styles/admin_style.css" />
</head>

<body>

  <div class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-flex">
        <div class="checkout_heading">
          <h1 id="Logo_name1">Easy</h1>
          <h1 id="Logo_name2">Net</h1>
        </div>
        <!-- <div class="brand-icons">
              <span class="las la-bell"></span>
              <span class="las la-user-circle"></span>
            </div>
        -->
      </div>
    </div>

    <div class="sidebar-main">
      <div class="sidebar-user">
        <div class="menu-head">
          <span>Admin</span>
        </div>
        <span>admin@gmail.com</span>
      </div>
    </div>

    <div class="sidebar-menu">
      <div class="menu-head">
        <span>Dashboard</span>
      </div>
      <ul>
        <li>
          <a href="admin.php">
            <span class="las la-chart-bar"></span>
            Analytics
          </a>
        </li>
        <li>
          <a href="orders.php">
            <span class="las la-shopping-cart"></span>
            Order
          </a>
        </li>
      </ul>

      <div class="menu-head">
        <span>Application</span>
      </div>
      <ul>
        <li>
          <a href="ecommerce.php">
            <span class="las la-store-alt"></span>
            Ecommerce
          </a>
        </li>
        <li>
          <a href="messages.php">
            <span class="las la-envelope"></span>
            Messages
          </a>
        </li>
        <li>
          <a href="users.php">
            <span class="las la-check-circle"></span>
            Users
          </a>
        </li>
        <li>
          <a href="index.php">
            <span class="las la-sign-out-alt"></span>
            Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
  </div>

  <div class="main-content">
    <div class="main-messages">
      <h1>Messages</h1>

      <?php
      // Retrieve messages from the database
      $sql = "SELECT * FROM message"; 
      $res = $conn->query($sql);

      if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
          echo "<div class='message'>";
          echo "<span class='message-sender'><b>Name:</b> " . $row["name"] . "</span>";
          echo "<p class='message-email'><b>Email:</b> " . $row["email"] . "</p>";
          echo "<p class='message-content'><b>Message:</b> " . $row["message"] . "</p>";
          echo "<div class='message-actions'>";
          echo "<form method='post' action='delete.php'>";
          echo "<input type='hidden' name='messageId' value='" . $row["message_id"] . "'>";
          echo "<button class='delete-message'>Delete</button>";
          // The reply button for messaging
          echo "<a href='mailto:" . $row["email"] . "?subject=Thank you%20for%20reaching%20out!' class='reply-button'>Reply</a>";
          echo "</form>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "No messages found.";
      }
      ?>
    </div>
</div>
    

    $conn->close();
  ?>

  

    </div>
  </div>
  
   <script src="_javascript/messages.js"></script>
   </body>

</body>
</html>