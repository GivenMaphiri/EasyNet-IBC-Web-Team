<?php

session_start();
include "DBConn.php";


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNet Dashboard | Users</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <link rel="stylesheet" href="_styles/admin_style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
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
          white-space: nowrap;
          max-width: 110px;
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

        #tr-none{
          background-color: white;          
        }

        .form-control {
          width: 500px;
          /* margin-top: 5px; */
          margin-left: 480px;
        }
      </style>

    <section style="margin: 50px;">
      <h1>List Of Users</h1>
      <br>

      <form action="" method="GET">
        <div class="input-group mb-3">
          <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search Users">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="users.php" class="btn btn-dangers">Reset</a>
        </div>
      </form>

      <table class="table">
        <thead>
          <tr>
            <th>User_ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php



            // search feature -- searhcing through the users name, number and email
            if(isset($_GET['search'])) {
              $filtervalues = $_GET['search'];
              $searchquery = "SELECT * FROM users WHERE CONCAT(first_name, last_name, phone_number, email_address) LIKE '%$filtervalues%' ";

              $searchquery_run = mysqli_query($conn, $searchquery);

              if(mysqli_num_rows($searchquery_run) > 0) {

                foreach($searchquery_run as $items) {
                  ?>
                    <tr>
                      <td><?= $items['user_ID']; ?></td>
                      <td><?= $items['first_name']; ?></td>
                      <td><?= $items['last_name']; ?></td>
                      <td><?= $items['phone_number']; ?></td>
                      <td><?= $items['email_address']; ?></td>
                      <td><a class='btn btn-dark' href='userDelete.php?id=" .$row["prod_ID"] ."'>Delete</a></td>
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
            $query = "SELECT * FROM users ORDER BY user_ID LIMIT $start_from, $records_per_page";
            $result = mysqli_query($conn, $query);

          if ($result->num_rows > 0) {
            // read data from each row
            while($row = $result->fetch_assoc()){

              echo "<tr>
              <td>" . $row["user_ID"] . "</td>
              <td>" . $row["first_name"] . "</td>
              <td>" . $row["last_name"] . "</td>
              <td>" . $row["phone_number"] . "</td>
              <td>" . $row["email_address"] . "</td>
              <td>
                
                <a class='btn btn-danger btn-sm' href='userDelete.php?id=" .$row["user_ID"] ."'>Delete</a>
              </td>
            </tr>";
            }
          }else {
            echo "0 results";
          }

          // Pagination links
          // echo "<tr><td colspan='6'>";
          // for ($i = 1; $i <= $total_pages; $i++) {
          //     echo "<a href='users.php?page=" . $i . "'>" . $i . "</a> ";
          // }
          // echo "</td></tr>";

          $conn->close();
          

          ?>
        </tbody>

        <!-- pagination links -->
        <tr id= "tr-none">
                      <td colspan="9">
                          <ul class="pagination">
                              <?php
                              if ($current_page > 1) {
                                  echo '<li><a href="users.php?page=' . ($current_page - 1) . '"> << Previous</a></li>';
                              }

                              $start_page = max(1, $current_page - 5);
                              $end_page = min($total_pages, $current_page + 5);

                              for ($i = $start_page; $i <= $end_page; $i++) {
                                  if ($i == $current_page) {
                                      echo '<li class="active"><a href="users.php?page=' . $i . '">' . $i . '</a></li>';
                                  } else {
                                      echo '<li><a href="users.php?page=' . $i . '">' . $i . '</a></li>';
                                  }
                              }

                              if ($current_page < $total_pages) {
                                  echo '<li><a href="users.php?page=' . ($current_page + 1) . '">Next >></a></li>';
                              }
                              ?>
                          </ul>
                      </td>
                  </tr>
          <!-- end of pagination links -->
      </table>

    </section>
  </main>
</div>

 




  <!-- main-content end -->
    
</body>
</html>