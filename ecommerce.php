<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
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

  <div class="main-content">

    <header>
      <div class="menu-toggle">
        <label for="sidebar-toggle">
          <span class="las la-bars"></span>
        </label>
      </div>

      <div class="header-icons">
        <span class="las la-search"></span>
        <span class="las la-bookmark"></span>
        <span class="las la-sms"></span>
      </div>
    </header>


    <div class="Product">
      <h1>Add New Product</h1>
      <form id="productForm">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        <label for="productDescription">Description:</label>
        <textarea id="productDescription" name="productDescription" required></textarea>

        <label for="productImage">Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/*" required>

        <label for="productPrice">Price:</label>
        <input type="number" id="productPrice" name="productPrice" min="0.01" step="0.01" required>

        <label for="productCategory">Category:</label>
        <select id="productCategory" name="productCategory" required>
          <option value="">Select Category</option>
          <option value="clothing">Hardware</option>
          <option value="electronics">Software</option>
          <option value="books">Accessories</option>
        </select>

        <label for="productStock">Stock:</label>
        <input type="number" id="productStock" name="productStock" min="0" required>

        <button type="submit">Add Product</button>
      </form>
    </div>
  </div>


</body>

</html>