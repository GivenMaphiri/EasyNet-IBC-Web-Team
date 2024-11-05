<?php
// Include your database connection file
session_start();
include "DBConn.php";

// Get the product ID from the URL
$productId = $_GET['id'];

// Check for dependencies
$sql_cart_count = "SELECT COUNT(*) FROM cart WHERE prod_ID = ?";
$stmt_cart_count = mysqli_prepare($conn, $sql_cart_count);
mysqli_stmt_bind_param($stmt_cart_count, "i", $productId);
mysqli_stmt_execute($stmt_cart_count);
mysqli_stmt_bind_result($stmt_cart_count, $cart_count);
mysqli_stmt_fetch($stmt_cart_count);
mysqli_stmt_close($stmt_cart_count);

$sql_favourite_count = "SELECT COUNT(*) FROM favourite WHERE prod_ID = ?";
$stmt_favourite_count = mysqli_prepare($conn, $sql_favourite_count);
mysqli_stmt_bind_param($stmt_favourite_count, "i", $productId);
mysqli_stmt_execute($stmt_favourite_count);
mysqli_stmt_bind_result($stmt_favourite_count, $favourite_count);
mysqli_stmt_fetch($stmt_favourite_count);
mysqli_stmt_close($stmt_favourite_count);

$sql_orders_count = "SELECT COUNT(*) FROM orders WHERE prod_ID = ?";
$stmt_orders_count = mysqli_prepare($conn, $sql_orders_count);
mysqli_stmt_bind_param($stmt_orders_count, "i", $productId);
mysqli_stmt_execute($stmt_orders_count);
mysqli_stmt_bind_result($stmt_orders_count, $orders_count);
mysqli_stmt_fetch($stmt_orders_count);
mysqli_stmt_close($stmt_orders_count);

// Display confirmation message if dependencies found
if ($cart_count > 0 || $favourite_count > 0 || $orders_count > 0) {
    echo "This product has associated records in other tables. Deleting this product will also delete these records. Are you sure you want to proceed?
    <form action='ecommerceDelete' method='post'>
        <input type='hidden' name='productId' value='$productId'>
        <button type='submit'>Confirm Delete</button>
        <a href='ecommerce.php'>Cancel</a>
    </form>";
} else {
    // Proceed with deletion
    $sql = "DELETE FROM products WHERE prod_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo
         '<script>
            alert("Product deleted successfully!");
            window.location.href = "ecommerce.php";
        </script>';
        exit();
    } else {
        echo "Error deleting product.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>



<?php
// // Include your database connection file
// session_start();
// include "DBConn.php";

// // Get the product ID from the URL
// $productId = $_GET['id'];

// // Prepare and execute the delete query
// $sql = "DELETE FROM products WHERE prod_ID = ?";
// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, "i", $productId);
// mysqli_stmt_execute($stmt);

// // Check if the deletion was successful
// if (mysqli_stmt_affected_rows($stmt) > 0) {
//     // Redirect back to the main page or display a success message
//     header("Location: ecommerce.php");
//     exit();
// } else {
//     echo "Error deleting product.";
// }

// mysqli_stmt_close($stmt);
// mysqli_close($conn);
?>