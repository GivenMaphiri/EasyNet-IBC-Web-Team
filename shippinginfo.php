<?php
session_start();
include "DBConn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_ID = $_SESSION['user_id']; // Ensure user is logged in
    $name = $_POST['name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];

    if (!ctype_digit($zip)) {
        die("Error: Zip code must contain numbers only.");
    }

    if (!ctype_digit($phone)) {
        die("Error: Phone number must contain numbers only.");
    }

    // Check if the user already has shipping information saved
    $sql = "SELECT * FROM shipping WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing shipping information
        $sql = "UPDATE shipping SET shipping_name=?, shipping_street=?, shipping_city=?, shipping_province=?, shipping_zip=?, shipping_phone=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiii", $name, $street, $city, $province, $zip, $phone, $user_ID);
    } else {
        // Insert new shipping information
        $sql = "INSERT INTO shipping (user_id, shipping_name, shipping_street, shipping_city, shipping_province, shipping_zip, shipping_phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssii", $user_ID, $name, $street, $city, $province, $zip, $phone);
    }

    if ($stmt->execute()) {
        echo "Shipping information saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
