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
    $productManufacturer = $_POST['productManufacturer'];
    $productType = $_POST['productType'];

    // Handle the image upload
    $targetDir = "_images/_products/";
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["productImage"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            // Extract just the file name (without the directory)
            $imageFileName = basename($_FILES["productImage"]["name"]);

            // Insert into the database with just the image file name
            $sql = "INSERT INTO products (prod_name, prod_code, prod_price, prod_description, prod_image, prod_manufacturer, prod_type) 
                    VALUES ('$productName', '$productCode', '$productPrice', '$productDescription', '$imageFileName', '$productManufacturer', '$productType')";

            if (mysqli_query($conn, $sql)) {
                header("Location: ecommerce.php");
                echo "Product added successfully.";
            } else {
                die("Error: " . $conn->error);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
