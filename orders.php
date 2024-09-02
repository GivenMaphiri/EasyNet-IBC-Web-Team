<?php

include 'DBConn.php';

session_start();

$sql = "SELECT order_ID, order_total, placed_on, payment_status, status FROM Orders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Track Order</title>
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
          <a href="">
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


  <!-- main-content -->
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

      <div class="page-header">
        <div>
          <h1>Orders Dashboard</h1>
          <small>keep track of orders as well as there status.</small>
        </div>
      </div>


  <form method="GET" action="">
    <label for="status">Filter by Status:</label>
    <select name="status" id="status">
        <option value="">All</option>
        <option value="Delivered">Delivered</option>
        <option value="Pending">Pending</option>
        <option value="Return">Return</option>
        <option value="In Progress">In Progress</option>
    </select>
    <button type="submit">Filter</button>
</form>



<!-- Table starts here -->

      <table>
      <style>
        table {
            border-collapse: collapse;
            width: 100%; /* Adjust width as needed */
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
        <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Placed on</th>
            <th>payment status</th>
            <th>status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_ID"] . "</td>";
                echo "<td>" . $row["order_total"] . "</td>";
                echo "<td>" . $row["placed_on"] . "</td>";
                echo "<td>" . $row["payment_status"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";

                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </table>



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
              <tr>
                <td>HP Laptop</td>
                <td>R 13,000</td>
                <td>Due</td>
                <td><span class="status inprogress">In Progress</span></td>
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
            </tbody>
          </table>
        </div>



      </div>

      <!------------- Table End-------------------------------------------------------------------------------->
    </main>
  </div>
  <!-- main-content end -->




</body>

</html>