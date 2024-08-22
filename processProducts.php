<?php

include "DBConn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_POST["create"])) {
    $productName = $_POST['productName'];
    $productCode = $_POST['productCode'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productImage = $_POST['productImage'];
    $productManufacturer = $_POST['productManufacturer'];
    $productType = $_POST['productType'];

   

    $sql = "INSERT INTO products (prod_name, prod_code, prod_price, prod_description, prod_image, prod_manufacturer, prod_type) VALUES ('$productName', '$productCode', '$productPrice', '$productDescription', '$productImage', '$productManufacturer', '$productType')";

    if (mysqli_query($conn, $sql)) {
        echo "Product added";
    }else {
        die("Something went wrong");
    }
    
}

?>