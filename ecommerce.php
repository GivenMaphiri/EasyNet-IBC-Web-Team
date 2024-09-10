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
        table {
            border-collapse: collapse;
            width: 100%; /* Adjust width as needed */
            padding: 10px;
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
    </style>

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

    <br>

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
                                echo "<button><a class='btn btn-primary btn-sm' href='ecommerceAdd.php?prod_ID=$row[prod_ID]'>Edit </a></button>";
                                echo "<button><a class='btn btn-danger btn-sm' href='ecommerceDelete.php?prod_ID=$row[prod_ID]'>Delete </a></button>";
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
    </main>

  
  


    
  </div>
<!-------------------------------------End of main-content -------------------------------------------------------->

</body>
</html>