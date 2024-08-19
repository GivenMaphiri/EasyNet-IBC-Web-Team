<?php

include 'DBConn.php';

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
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
          <a href="#">
            <span class="las la-check-circle"></span>
            Tasks
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

  <script src="_javascript/admin.js"></script>
  <!--  -->

  <!-- main-content -->
  <div class="main-content">
    <header>
      <div class="menu-toggle">
        <label for="sidebar-toggle">
         <!-- <span class="las la-bars"></span> -->
        </label>
      </div>

      <div class="header-icons">
        <span class="las la-sms"></span>
      </div>
    </header>

    <main>
      <div class="page-header">
        <div>
          <h1>Analytics Dashboard</h1>
          <small>Monitor Key metrics. Check reporting and reviews insights</small>
        </div>
      </div>
      <!------------- Cards start-------------------------------------------------------------------------------->
      <div class="cards">
        
<!-- User Card-->
        <div class="card-single">

         <!-- counts the number of rows in the users table and dispalys it as the total number of orders placed.-->
        <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
          ?>
          <div class="card-flex">
            <div class="card-info">
              <div class="card-head">
                <span>Users</span>
                <small>Number of users</small>
              </div>

              <h2><?php echo $number_of_users; ?></h2>   <!-- the number of users-->

              <!--<small>5% less users</small> -->
            </div>
            <div class="card-chart danger">
              <span class="las la-chart-line"></span>
            </div>
          </div>
        </div>


        <!-- Orders Card-->
        <div class="card-single">

         <!-- counts the number of rows in the users table and dispalys it as the total number of orders placed.-->
        <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `Orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
          ?>
          <div class="card-flex">
            <div class="card-info">
              <div class="card-head">
                <span>Orders</span>
                <small>Number of Orders placed</small>
              </div>

              <h2><?php echo $number_of_orders; ?></h2>   <!-- the number of orders placed-->

              <!--<small>5% less users</small> -->
            </div>
            <div class="card-chart danger">
              <span class="las la-chart-line"></span>
            </div>
          </div>
        </div>

<!-- Revenue card-->
        <div class="card-single">
          <div class="card-flex">
            <div class="card-info">
              <div class="card-head">
                <span>Revenue</span>
                <small>Revenue this month</small>
              </div>

              <h2>R 150,000</h2>

              <!--<small>5% more profits</small> -->
            </div>
            <div class="card-chart success">
              <span class="las la-chart-line"></span>
            </div>
          </div>
        </div>


<!-- Visitors card-->
        <div class="card-single">
          <div class="card-flex">
            <div class="card-info">
              <div class="card-head">
                <span>visitors</span>
                <small>Number of visitors</small>
              </div>

              <h2>1500</h2>

              <!--<small>3% less visitors</small> -->
            </div>
            <div class="card-chart yellow">
              <span class="las la-chart-line"></span>
            </div>
          </div>
        </div>


      </div>

      <!------------- Table start-------------------------------------------------------------------------------->
      <div class="details">
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Recent Orders</h2>
            <a href="orders.php" class="btn">View All</a>
          </div>
          <table>
            <thead>
              <tr>
                <td>Name</td>
                <td>Price</td>
                <td>Payment</td>
                <td>Status</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>MacBook Air M3 15'</td>
                <td>R 30,000</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
              </tr>
              <tr>
                <td>Windows 365</td>
                <td>R 2,256</td>
                <td>Due</td>
                <td><span class="status pending">Pending</span></td>
              </tr>
              <tr>
                <td>Keychron k2 mechanical keyboard</td>
                <td>R 5,000</td>
                <td>Paid</td>
                <td><span class="status return">Return</span></td>
              </tr>
              <tr>
                <td>HP Laptop</td>
                <td>R 13,000</td>
                <td>Due</td>
                <td><span class="status inprogress">In Progress</span></td>
              </tr>
              <tr>
                <td>Apple Watch</td>
                <td>R 15,000</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
              </tr>
              <tr>
                <td>MacBook Air M3 15'</td>
                <td>R 30,000</td>
                <td>Paid</td>
                <td><span class="status delivered">Delivered</span></td>
              </tr>
              <tr>
                <td>Windows 365</td>
                <td>R 2,256</td>
                <td>Due</td>
                <td><span class="status pending">Pending</span></td>
              </tr>
              <tr>
                <td>Keychron k2 mechanical keyboard</td>
                <td>R 5,000</td>
                <td>Paid</td>
                <td><span class="status return">Return</span></td>
              </tr>
              <tr>
                <td>HP Laptop</td>
                <td>R 13,000</td>
                <td>Due</td>
                <td><span class="status inprogress">In Progress</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <div class="recentCustomers">
            <h2>Recent Customers</h2>
          </div>
        -->


      </div>

      <!------------- Table End-------------------------------------------------------------------------------->
    </main>
  </div>
  <!-- main-content end -->

  <label for="sidebar-toggle" class="body-label"></label>
</body>

</html>