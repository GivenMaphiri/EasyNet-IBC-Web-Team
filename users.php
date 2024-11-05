<?php

session_start();
include "DBConn.php";

// Fetch admin email
$sql = "SELECT admin_email FROM admin";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $adminEmail = $row['admin_email'];
} else {
  $adminEmail = "No admin email found.";
}


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
    <title>EasyNet Dashboard | Clients</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <link rel="stylesheet" href="_styles/admin_style.css" />
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>  -->

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
          margin-left: 380px;
        }
    </style>

      <div class="page-header">
        <div>
          <h1>Client Dashboard</h1>
          <small>Keep track of all your clients.</small>
        </div>
      </div>

    <section style="margin: 10px;">
    <div class="container my-5">
        <h2>Lists Of Clients</h2>
        <a class="btn btn-primary" href="clientAdd.php" role="button">New Client</a>
        <br>


      <table id="userTable" class="table">
        <thead>
          <tr>
            <th>Client_ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php

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
                <a class='btn btn-secondary btn-sm' href='mailto:" . $row["email"] . "?subject=Thank you%20for%20reaching%20out!' class='reply-button'>Email</a>
                <a class='btn btn-danger btn-sm' href='userDelete.php?id=" .$row["user_ID"] ."'>Delete</a>
              </td>
            </tr>";
            }
          }else {
            echo "0 results";
          }

          $conn->close();
          

          ?>
        </tbody>

      </table>

      <!-- JQuery -->
    <script src="_lib/jquery/jquery-3.7.1.min.js"></script>

      <!-- DataTables -->
      <script src="_lib/datatables/dataTables.js"></script>

      <script>
          $(document).ready( function () {
              $('#userTable').DataTable();
          } );
      </script>

    </section>
  </main>


</div>
  <!-- main-content end -->
    
</body>
</html>