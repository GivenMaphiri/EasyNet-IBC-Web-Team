<?php
include "DBConn.php";

// Function to hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Dummy data array
// $users = [
//     ['John', 'Doe', '123-456-7890', 'john.doe@example.com', 'password123'],
//     ['Jane', 'Smith', '987-654-3210', 'jane.smith@example.com', 'password456'],
//     ['Alice', 'Johnson', '555-123-4567', 'alice.johnson@example.com', 'password789'],
//     ['Bob', 'Brown', '444-987-6543', 'bob.brown@example.com', 'password321'],
//     ['Charlie', 'Davis', '333-654-9876', 'charlie.davis@example.com', 'password654'],
// ];

// Loop through the dummy data and insert into the database
foreach ($users as $user) {
    $firstName = $user[0];
    $lastName = $user[1];
    $phoneNumber = $user[2];
    $emailAddress = $user[3];
    $password = hashPassword($user[4]);

    $sql = "INSERT INTO users (first_name, last_name, phone_number, email_address, password) 
            VALUES ('$firstName', '$lastName', '$phoneNumber', '$emailAddress', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully for $firstName $lastName<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
    }
}

// Close the database connection
$conn->close();
?>
