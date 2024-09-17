<?php
include 'DBConn.php';

session_start();

// Query to count products for each product type
$sql = "SELECT prod_type, COUNT(*) as product_count FROM products GROUP BY prod_type";
$result = $conn->query($sql);

// Store product counts in an array
$productCounts = [];
while ($row = $result->fetch_assoc()) {
    $productCounts[$row['prod_type']] = $row['product_count'];
}

// Return the data as JSON
echo json_encode(array('productCounts' => $productCounts));

$conn->close();
?>