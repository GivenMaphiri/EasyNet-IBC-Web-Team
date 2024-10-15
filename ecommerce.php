<?php
session_start();
include "DBConn.php";


$sql = "SELECT prod_ID, prod_name, prod_code, prod_description, prod_price, prod_image, prod_manufacturer, prod_type FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNet Dashboard | Products Dashboard</title>

    <!-- line awesome cdn link  -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="_styles/admin_style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link href="_styles/font-awesome.css" rel="stylesheet" />

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

  <!------------------------------------- main-content -------------------------------------------------------->

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
          <h1>Products Dashboard</h1>
          <small>Keep track of your products.</small>
        </div>
      </div>


      <div class="container my-5">
        <h2>Lists Of Products</h2>
        <a class="btn btn-primary" href="ecommerceAdd.php" role="button">New Product</a>
        <br>

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

        <!-- filter code for the filter feature -->
        
            <!-- <form action="" method="GET">
              <div class="row">
                
                <div class="col-md-4">
                  <select name="prod_type" required class="form-select">
                    <option value="">Select Product Type</option>
                    <option value="Hardware" <?= isset($_GET['prod_type']) == true ? ($_GET['prod_type'] == 'Hardware' ? 'selected': '') :'' ?>>Hardware</option>
                    <option value="Software" <?= isset($_GET['prod_type']) == true ? ($_GET['prod_type'] == 'Software'  ? 'selected': '') :'' ?>>Software</option>
                    <option value="Accessories" <?= isset($_GET['prod_type']) == true ? ($_GET['prod_type'] == 'Accessories'  ? 'selected': ''):'' ?>>Accessories</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-secondary">Filter</button>
                  <a href="ecommerce.php" class="btn btn-dangers">Reset</a>
                </div>
              </div>
            </form> -->
          <br>
      
        <!-- search form for search feature -->
      <form action="" method="GET">
        <div class="input-group mb-3">
          <!-- <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="form-control" placeholder="Search Products">
          <button type="submit" class="btn btn-primary">Search</button> -->
          <a href="ecommerce.php" class="btn btn-dangers">Reset</a>
        </div>
      </form>
      
      

      <br>
          <table id="prodTable" class="table">
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

                      // filter feature ---- 
                      // if(isset($_GET['prod_type']) &&  $_GET['prod_type'] != '') {

                      //   $prod_type= validate($_GET['prod_type']);
                      //   $filterquery = "SELECT * FROM products WHERE prod_type= $prod_type";
                      // } else {

                      //   $filterquery = "SELECT * FROM products WHERE prod_type= $prod_type";
                      // }


                      // search feature -- searhcing through the products name, code and manufacturer
                      if(isset($_GET['search'])) {
                        $filtervalues = $_GET['search'];
                        $searchquery = "SELECT * FROM products WHERE CONCAT(prod_name, prod_code, prod_manufacturer) LIKE '%$filtervalues%' ";

                        $searchquery_run = mysqli_query($conn, $searchquery);

                        if(mysqli_num_rows($searchquery_run) > 0) {

                          foreach($searchquery_run as $items) {
                            ?>
                              <tr>
                                <td><?= $items['prod_ID']; ?></td>
                                <td><?= $items['prod_name']; ?></td>
                                <td><?= $items['prod_code']; ?></td>
                                <td><?= $items['prod_description']; ?></td>
                                <td><?= $items['prod_price']; ?></td>
                                <td><?= $items['prod_image']; ?></td>
                                <td><?= $items['prod_manufacturer']; ?></td>
                                <td><?= $items['prod_type']; ?></td>
                                <td><a class='search-btn' href='ecommerceDelete.php?id=" .$row["prod_ID"] ."'>Delete</a></td>
                              </tr>
                            <?php
                          }
                        } else {
                          ?>

                          <tr>
                            <td colspan="9">No records Found</td>
                          </tr>

                          <?php
                        }
                      }

                      // Pagination variables
                      $records_per_page = 14; // Adjust as needed
                      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                      $start_from = ($current_page - 1) * $records_per_page;

                      // Fetch total records
                      $total_records = mysqli_num_rows($result);

                      // Calculate total pages
                      $total_pages = ceil($total_records / $records_per_page);

                       // Define the maximum number of pages to display at a time
                      $max_pages_to_show = 10;

                      

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
                                // echo "<a href='ecommerceEdit.php?id=" . $row["prod_ID"] . "'><span class='fa-light fa-pen-to-square'></span></a>";
                                // echo "<a href='ecommerceDelete.php?id=" . $row["prod_ID"] . "'><span class='fa-solid fa-delete-left'></span></a>";
                                echo "<a class='btn btn-danger btn-sm' href='ecommerceDelete.php?id=" .$row["prod_ID"] ."'>Delete</a>";
                              echo "</td>";

                              echo "</tr>";
                          }
                      } else {
                          echo "0 results";
                      }

                      // Pagination links
                      // echo "<tr><td colspan='9'>";
                      // for ($i = 1; $i <= $total_pages; $i++) {
                      //     echo "<a href='ecommerce.php?page=" . $i . "'>" . $i . "</a> ";
                      // }
                      // echo "</td></tr>";

                      


                      $conn->close();
                  ?>

          <!-- pagination links -->
                <!-- <tr id= "tr-none">
                      <td colspan="9">
                          <ul class="pagination">
                              <?php
                              if ($current_page > 1) {
                                  echo '<li><a href="ecommerce.php?page=' . ($current_page - 1) . '"> << Previous</a></li>';
                              }

                              $start_page = max(1, $current_page - 5);
                              $end_page = min($total_pages, $current_page + 5);

                              for ($i = $start_page; $i <= $end_page; $i++) {
                                  if ($i == $current_page) {
                                      echo '<li class="active"><a href="ecommerce.php?page=' . $i . '">' . $i . '</a></li>';
                                  } else {
                                      echo '<li><a href="ecommerce.php?page=' . $i . '">' . $i . '</a></li>';
                                  }
                              }

                              if ($current_page < $total_pages) {
                                  echo '<li><a href="ecommerce.php?page=' . ($current_page + 1) . '">Next >></a></li>';
                              }
                              ?>
                          </ul>
                      </td>
                  </tr> -->
          <!-- end of pagination links -->
              </tbody>
          </table>

          <!-- JQuery -->
          <script src="_lib/jquery/jquery-3.7.1.min.js"></script>

          <!-- DataTables -->
          <script src="_lib/datatables/dataTables.js"></script>

          <script>
              $(document).ready( function () {
                  $('#prodTable').DataTable();
              } );
          </script>
          
      </div>
    </main>
  </div>
<!-------------------------------------End of main-content -------------------------------------------------------->

</body>
</html>