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

      <style>
        .table tbody tr:hover {
              background-color: #d7dbdd ; /* Adjust the background color as needed */
              cursor: pointer;
            }

        .form-control {
          width: 500px;
          /* margin-top: 5px; */
          margin-left: 480px;
        }

        .btn-dangers {
            background-color: #f3810f;
            border-color: black;
          }
      </style>

      <div class="page-header">
        <div>
          <h1>Orders Dashboard</h1>
          <small>keep track of orders as well as there status.</small>
        </div>
      </div>


      <!-- <form method="GET" action="">
        <label for="status">Filter by Status:</label>
        <select name="status" id="status">
            <option value="">All</option>
            <option value="Delivered">Delivered</option>
            <option value="Pending">Pending</option>
            <option value="Return">Return</option>
            <option value="In Progress">In Progress</option>
        </select>
        <button type="submit">Filter</button>
      </form> -->

      <form action="" method="GET">
        <div class="input-group mb-3">
          <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search Users">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="orders.php" class="btn btn-dangers">Reset</a>
        </div>
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
          // search feature -- searhcing through the users name, number and email
          if(isset($_GET['search'])) {
            $filtervalues = $_GET['search'];
            $searchquery = "SELECT * FROM orders WHERE CONCAT(order_total, payement_status, status) LIKE '%$filtervalues%' ";

            $searchquery_run = mysqli_query($conn, $searchquery);

            if(mysqli_num_rows($searchquery_run) > 0) {

              foreach($searchquery_run as $items) {
                ?>
                  <tr>
                    <td><?= $items['order_ID']; ?></td>
                    <td><?= $items['order_total']; ?></td>
                    <td><?= $items['placed_on']; ?></td>
                    <td><?= $items['payement_status']; ?></td>
                    <td><?= $items['status']; ?></td>
                    <td><a class='btn btn-dark' href='ordersDelete.php?id=" .$row["prod_ID"] ."'>Delete</a></td>
                  </tr>
                <?php
              }
            } else {
              ?>

              <tr>
                <td colspan="5">No records Found</td>
              </tr>

              <?php
            }
          }


          // Pagination variables
          $records_per_page = 15; // Adjust as needed
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
          $start_from = ($current_page - 1) * $records_per_page;

          // Fetch total records
          $total_records = mysqli_num_rows($result);

          // Calculate total pages
          $total_pages = ceil($total_records / $records_per_page);

          // Modify the query to include LIMIT clause
          $query = "SELECT * FROM orders ORDER BY order_ID LIMIT $start_from, $records_per_page";
          $result = mysqli_query($conn, $query);




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


        // Pagination links
        echo "<tr><td colspan='5'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='ecommerce.php?page=" . $i . "'>" . $i . "</a> ";
        }
        echo "</td></tr>";


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