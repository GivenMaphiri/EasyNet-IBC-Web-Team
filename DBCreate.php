<?php
$servername = "localhost";
$username = "root"; // Change this if needed
$password = ""; // Change this if needed
$dbname = "easynet";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// SQL to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    user_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone_number VARCHAR(15),
    email_address VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully<br>";
} else {
    echo "Error creating table 'users': " . $conn->error;
}

// SQL to create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
    prod_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    prod_name VARCHAR(100) NOT NULL,
    prod_code VARCHAR(20) NOT NULL UNIQUE,
    prod_price DECIMAL(10, 2) NOT NULL,
    prod_description TEXT,
    prod_image VARCHAR(255),
    prod_manufacturer VARCHAR(50),
    prod_type VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'products' created successfully<br>";
} else {
    echo "Error creating table 'products': " . $conn->error;
}

// SQL to create cart table
$sql = "CREATE TABLE IF NOT EXISTS cart (
    cart_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_ID INT(11),
    prod_ID INT(11),
    prod_name VARCHAR(100),
    prod_price DECIMAL(10, 2),
    prod_image VARCHAR(255),
    quantity INT(11),
    cart_excTotal DECIMAL(10, 2),
    cart_VAT DECIMAL(10, 2),
    cart_incTotal DECIMAL(10, 2),
    FOREIGN KEY (user_ID) REFERENCES users(user_ID),
    FOREIGN KEY (prod_ID) REFERENCES products(prod_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'cart' created successfully<br>";
} else {
    echo "Error creating table 'cart': " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS  shipping (
    shipping_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_ID INT(11) NOT NULL,
    shipping_name VARCHAR(255),
    shipping_street VARCHAR(255),
    shipping_city VARCHAR(255),
    shipping_province VARCHAR(255),
    shipping_zip INT(11),
    shipping_phone INT(11),
    FOREIGN KEY (user_ID) REFERENCES users(user_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'shipping' created successfully<br>";
} else {
    echo "Error creating table 'shipping': " . $conn->error;
}


$sql = "CREATE TABLE IF NOT EXISTS orders (
    order_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_ID INT(11) NOT NULL,
    prod_ID INT(11) NOT NULL,
    order_total DECIMAL(10, 2) NOT NULL,
    placed_on DATETIME NOT NULL DEFAULT CURRENT_TIME,
    shipping_ID INT(11) NOT NULL, 
    payment_method VARCHAR(255) NOT NULL, 
    payment_status ENUM('Paid', 'Due', 'Refunded') NOT NULL,
    status ENUM('Pending', 'In Progress', 'Delivered') NOT NULL,
    FOREIGN KEY (user_ID) REFERENCES users(user_ID), 
    FOREIGN KEY (prod_ID) REFERENCES products(prod_ID),
    FOREIGN KEY (shipping_ID) REFERENCES shipping(shipping_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'orders' created successfully<br>";
} else {
    echo "Error creating table 'orders': " . $conn->error;
}

//Creates the message table in the database

$sql = "CREATE TABLE IF NOT EXISTS message (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'message' created successfully<br>";
} else {
    echo "Error creating message table: " . $conn->error;
}



$sql = "CREATE TABLE IF NOT EXISTS favourite (
    favourite_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_ID INT(11),
    prod_ID INT(11),
    prod_name VARCHAR(100),
    prod_price DECIMAL(10, 2),
    prod_image VARCHAR(255),
    FOREIGN KEY (user_ID) REFERENCES users(user_ID),
    FOREIGN KEY (prod_ID) REFERENCES products(prod_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'favourite' created successfully<br>";
} else {
    echo "Error creating table 'cart': " . $conn->error;
}


// SQL to create users table
$sql = "CREATE TABLE IF NOT EXISTS admin (
    admin_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    admin_email VARCHAR(100) NOT NULL UNIQUE,
    admin_password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'admin' created successfully<br>";
} else {
    echo "Error creating table 'admin': " . $conn->error;
}

// Close connection 
$conn->close();
