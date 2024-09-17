<?php

include 'DBConn.php';

session_start();

$sql = "SELECT prod_ID, prod_name, prod_code, prod_description, prod_price, prod_image, prod_manufacturer, prod_type FROM products";
$result = $conn->query($sql);

// ----------------------------------------------------------

$barquery = mysqli_query($conn, "SELECT * FROM `products` Where prod_type = 'Hardware' ") or die('query failed');
$numhardware = mysqli_num_rows($barquery);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1" />
  <title>EasyNet| Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
  <link rel="stylesheet" href="_styles/admin_style.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
        <a href="messages.php"><span class="las la-sms"></span></a>
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
        <!-- <div class="card-single">
          <div class="card-flex">
            <div class="card-info">
              <div class="card-head">
                <span>Revenue</span>
                <small>Revenue this month</small>
              </div>

              <h2>R 150,000</h2>

              
            </div>
            <div class="card-chart success">
              <span class="las la-chart-line"></span>
            </div>
          </div>
        </div> -->


<!-- Products card-->
        <div class="card-single">

          <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
          ?>
          <div class="card-flex">
            <div class="card-info">
              <div class="card-head">
                <span>Inventory</span>
                <small>Number of products available</small>
              </div>

              <h2><?php echo $number_of_products; ?></h2>

              <!--<small>3% less visitors</small> -->
            </div>
            <div class="card-chart yellow">
              <span class="las la-chart-line"></span>
            </div>
          </div>
        </div>
      </div>

       <!------------- chart start-------------------------------------------------------------------------------->
       <!-- <div style="width: 500px;">
          <canvas id="myChart"></canvas>
       </div>


       <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Hardware', 'Software', 'Accessories'],
            datasets: [{
              label: '# of Products for category',
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });


        const config = {
          type: 'bar',
          data: data,
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          },
        };

        var myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
      </script> -->

      <br>

    <div class="card-single" id="barChart" style="width: 720px;">
      <canvas id="productTypeChart" ></canvas>
    </div>

    <br>
    
    <script>
        // Replace with your database connection details
        var conn = new XMLHttpRequest();
        conn.open("GET", "fetch_product_type_data.php", true);
        conn.onreadystatechange = function() {
            if (conn.readyState == 4 && conn.status == 200) {
                var data = JSON.parse(conn.responseText);

                var ctx = document.getElementById('productTypeChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Hardware', 'Software', 'Accessories'],
                        datasets: [{
                            label: '# of Products for category',
                            data: data.productCounts,
                            borderWidth: 1,
                            backgroundColor: ['rgba(153, 102, 255, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'], // Custom colors for each bar
                            borderColor: ['rgb(153, 102, 255)', '#36A2EB', 'rgb(75, 192, 192)']
                        }]
                    }
                });
            }
        };
        conn.send();
    </script>

     

       <!------------- chart end-------------------------------------------------------------------------------->

       

      <!------------- Table start-------------------------------------------------------------------------------->

      <style>
          .table {
              border: 1px solid #ddd;
              margin-bottom: 20px;
              border-collapse: collapse;
              width: 100%; /* Adjust width as needed */
              padding: 10px;

          }

          #barChart {
            display: flex;
          }

            .table thead th {
              background-color: #312f2f;
              color: white;
              font-weight: bold;
            }

            .table tbody tr:nth-child(even) {
                background-color: #ffff;
            }

          th, td {
              border: 1px solid black;
              padding: 8px;
              text-align: left;
          }

          th {
              background-color: #f2f2f2;
          }

          td {
            /* overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 110px; */
          }

          a{
            /* padding-left: 2px; */
          }

          .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
          }

          .btn-dangers {
            background-color: #f3810f;
            border-color: black;
          }

          .btn-sm {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.25;
          }

          .table tbody tr:hover {
            background-color: #d7dbdd ; /* Adjust the background color as needed */
            cursor: pointer;
          }

          .form-control {
            width: 500px;
            /* margin-top: 5px; */
            margin-left: 480px;
          }
        </style>
      <div >
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Products Overview</h2>
            <a href="ecommerce.php" class="btn">View All</a>
          </div>
          <table class="table">
              <thead>
                  <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Manufacturer</th>
                  <th>Type</th>
                  <th>Action</th>
                  </tr>
                  
              </thead>

              <tbody>
                  <?php

                      // Pagination variables
                      $records_per_page = 5; // Adjust as needed
                      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                      $start_from = ($current_page - 1) * $records_per_page;

                      // Fetch total records
                      $total_records = mysqli_num_rows($result);

                      // Calculate total pages
                      $total_pages = ceil($total_records / $records_per_page);

                      // Modify the query to include LIMIT clause
                      $query = "SELECT * FROM products ORDER BY prod_ID LIMIT $start_from, $records_per_page";
                      $result = mysqli_query($conn, $query);


                      if ($result->num_rows > 0) {
                          // Output data of each row
                          while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>" . $row["prod_ID"] . "</td>";
                              echo "<td>" . $row["prod_name"] . "</td>";
                              echo "<td>" . $row["prod_code"] . "</td>";
                              echo "<td>" . $row["prod_description"] . "</td>";
                              echo "<td>R" . $row["prod_price"] . "</td>";
                              echo "<td>" . $row["prod_image"] . "</td>";
                              echo "<td>" . $row["prod_manufacturer"] . "</td>";
                              echo "<td>" . $row["prod_type"] . "</td>";

                              echo "<td>";
                                echo "<a class='btn btn-danger btn-sm' href='ecommerceDelete.php?id=" .$row["prod_ID"] ."'>Delete</a>";
                              echo "</td>";

                              echo "</tr>";
                          }
                      } else {
                          echo "0 results";
                      }


                      $conn->close();
                  ?>
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