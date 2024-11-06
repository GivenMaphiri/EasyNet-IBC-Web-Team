<?php
// Check connection
session_start(); // Start the session
include "DBConn.php"; // Include your database connection


// Fetch admin email
$sql = "SELECT admin_email FROM admin";
$result = mysqli_query($conn, $sql);
$adminEmail = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result)['admin_email'] : "No admin email found.";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Filter replied/unreplied messages based on query parameter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$sql = "SELECT * FROM message";
if ($filter === 'replied') {
    $sql .= " WHERE replied = 1";
} elseif ($filter === 'unreplied') {
    $sql .= " WHERE replied = 0";
}
$sql .= " ORDER BY timestamp DESC";
$res = $conn->query($sql);

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
    <!-- Sidebar content here -->
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
        <span><?php echo $adminEmail; ?></span>
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
            <span class="las la-users"></span>
            Clients
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
</div>

<div class="main-content">
    
    <header>
      <div class="menu-toggle">
        <label for="sidebar-toggle">
         <!-- <span class="las la-bars"></span> -->
        </label>
      </div>

      <div class="header-icons">
        
        <a href="messages.php"><span class="las la-sms"></span></a>
      </div>
    </header>

  <main>

    <main>
        <div class="main-messages">
            <h1>Messages</h1>

            <!-- Filter Buttons -->
            <div class="message-filter">
              <a href="messages.php?filter=all" class="filter-button">All Messages</a>
              <a href="messages.php?filter=replied" class="filter-button">Replied</a>
              <a href="messages.php?filter=unreplied" class="filter-button">Unreplied</a>
            </div>

            <?php
            if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc()) {
                    echo "<div class='message'>";
                    echo "<span class='message-sender'><b>Name:</b> " . $row["name"] . "</span>";
                    echo "<p class='message-email'><b>Email:</b> " . $row["email"] . "</p>";
                    echo "<p class='message-content'><b>Message:</b> " . $row["message"] . "</p>";
                    echo "<div class='message-actions'>";
                    echo "<form method='post' action='reply.php'>";
                    echo "<input type='hidden' name='messageId' value='" . $row["message_id"] . "'>";
                    echo "<button class='delete-message'>Delete</button>";

                    // Reply button changes to 'Replied' if already replied
                    if ($row["replied"] == 1) {
                      echo "<button class='replied-button' disabled>Replied</button>";
                  } else {
                      echo "<a href='mailto:" . $row["email"] . "?subject=Thank you%20for%20reaching%20out!' class='reply-button'>Reply</a>";
                      echo "<form method='post' action='mark_as_replied.php' style='display:inline;'>";
                      echo "<input type='hidden' name='messageId' value='" . $row["message_id"] . "'>";
                      echo "<button type='submit' class='mark-replied-button'>Mark as Replied</button>";
                      echo "</form>";
                  }

                    echo "</form>";
                    echo "</div>";
                    echo "<span class='message-timestamp'><b>Time: </b> " . $row["timestamp"] . "</span>";
                    echo "</div>";
                }
            } else {
                echo "No messages found.";
            }

            $conn->close();
            ?>
        </div>
    </main>
</div>

<script src="_javascript/messages.js"></script>
</body>
</html>