<?php
session_start();
include "DBConn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyNet Dashboard | Products</title>
  <!-- line awesome cdn link  -->
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!-- custom css file link  -->
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

  <div class="main-content">




    <div class="Product">
      <h1>Add New Product</h1>
      <form id="productForm" action="processProducts.php" method="post" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        <label for="productCode">Product Code:</label>
        <input type="text" id="productCode" name="productCode" required>

        <label for="productDescription">Description:</label>
        <textarea id="productDescription" name="productDescription" placeholder="Product description:" required></textarea>

        <label for="productPrice">Price:</label>
        <input type="number" id="productPrice" name="productPrice" min="0.01" step="0.01" placeholder="ZAR" required>

        <label for="productImage">Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/*" required>

        <label for="productManufacturer">Product Manufacturer:</label>
        <input type="text" id="productManufacturer" name="productManufacturer" required>


        <label for="productType">Product Type:</label>
        <select id="productType" name="productType" required>
          <option value="">Select Category</option>
          <option value="hardware">Hardware</option>
          <option value="software">Software</option>
          <option value="accessories">Accessories</option>
        </select>

        <button type="submit" name="create" value="Add Product">Add Product</button>
      </form>
    </div>
  </div>


</body>

</html>