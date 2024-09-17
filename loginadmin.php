<?php 

session_start();
include "DBConn.php";

// Retrieve form data
$admin_email = $_POST['admin_email'];
$admin_password = $_POST['admin_password'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?");
$stmt->bind_param("ss", $admin_email, $admin_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Successful login, set session variable   

    $_SESSION['admin_logged_in'] = true;
    header("Location: admin.php");
    exit();
} else {
    // Invalid login credentials
    echo "Invalid email or password.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNet IBC | Admin Login</title>
    <link rel="shortcut icon" type="image/png" href="_images/_logos/easynet_icon.png" />
    <link href="_styles/style.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    

<style>
    form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #3e8e41;
}
</style>

<form action="loginadmin.php" method="POST" >
    <label for="admin_email">Email:</label>
    <input type="email" id="admin_email" name="admin_email" required>
    <br>
    <label for="admin_password">Password:</label>
    <input type="password" id="admin_password" name="admin_password" required>
    <br>
    <button type="submit">Login</button>
</form> 


    
</body>
</html>