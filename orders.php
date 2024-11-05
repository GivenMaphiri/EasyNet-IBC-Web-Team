<?php

include 'DBConn.php';

session_start();

$sql = "SELECT order_ID, order_total, placed_on, user_ID, payment_status, status FROM orders";
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

 <!-- DataTables -->
 <link rel="stylesheet" href="_lib/datatables/dataTables.css"> 
  
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
        
        .table {
              border: 1px solid #ddd;
              margin-bottom: 20px;
              border-collapse: collapse;
              width: 100%; /* Adjust width as needed */
              padding: 10px;

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
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: wrap;
            max-width: 110px;
          }

        
      </style>

      <div class="page-header">
        <div>
          <h1>Orders Dashboard</h1>
          <small>keep track of orders as well as there status.</small>
        </div>
      </div>


      

      <!-- Table starts here -->
       
      <table id="orderTable" class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Placed on</th>
            <th>User_ID</th>
            <th>Payment status</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>

          <?php

          if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["order_ID"] . "</td>";
              echo "<td>" . $row["order_total"] . "</td>";
              echo "<td>" . $row["placed_on"] . "</td>";
              echo "<td>" . $row["user_ID"] . "</td>";
              echo "<td>" . $row["payment_status"] . "</td>";
              echo "<td>" . $row["status"] . "</td>";
        echo "<td>";
        echo '<form method="post" action="update_order_status.php">';
                echo '<input type="hidden" name="order_id" value="' . $row["order_ID"] . '">';
                echo '<select name="status">';
                echo '<option value="Pending" ' . ($row["status"] == "Pending" ? "selected" : "") . '>Pending</option>';
                echo '<option value="In Progress" ' . ($row["status"] == "In Progress" ? "selected" : "") . '>In Progress</option>';
                echo '<option value="Delivered" ' . ($row["status"] == "Delivered" ? "selected" : "") . '>Delivered</option>';
                echo '</select>';
                echo '<button class="btn btn-danger btn-sm" type="submit">Update</button>';
        echo '</form>';
        echo "</td>";

              echo "</tr>";
            }
          } else {
            echo "0 results";
          }

          $conn->close();
          ?>

          <!-- pagination links -->
          <!-- <tr id= "tr-none">
                      <td colspan="9">
                          <ul class="pagination">
                              <?php
                              // if ($current_page > 1) {
                              //     echo '<li><a href="orders.php?page=' . ($current_page - 1) . '"> << Previous</a></li>';
                              // }

                              // $start_page = max(1, $current_page - 5);
                              // $end_page = min($total_pages, $current_page + 5);

                              // for ($i = $start_page; $i <= $end_page; $i++) {
                              //     if ($i == $current_page) {
                              //         echo '<li class="active"><a href="orders.php?page=' . $i . '">' . $i . '</a></li>';
                              //     } else {
                              //         echo '<li><a href="orders.php?page=' . $i . '">' . $i . '</a></li>';
                              //     }
                              // }

                              // if ($current_page < $total_pages) {
                              //     echo '<li><a href="orders.php?page=' . ($current_page + 1) . '">Next >></a></li>';
                              // }
                              ?>
                          </ul>
                      </td>
                  </tr> -->
          <!-- end of pagination links -->
        </tbody>
        
      </table>



      <!------------- Table start-------------------------------------------------------------------------------->

        <!-- JQuery -->
        <script src="_lib/jquery/jquery-3.7.1.min.js"></script>

        <!-- DataTables -->
        <script src="_lib/datatables/dataTables.js"></script>

        <script>
            $(document).ready( function () {
                $('#orderTable').DataTable();
            } );
        </script>
      
     



  </div>


  <!------------- Table End-------------------------------------------------------------------------------->
  </main>
  </div>
  <!-- main-content end -->

  



</body>

</html>