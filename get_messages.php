<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection

$sql = "SELECT m.message_id, u.first_name, u.last_name, u.email_address, m.message_content, m.timestamp 
        FROM messages m
        JOIN users u ON m.user_id = u.user_ID 
        ORDER BY m.timestamp DESC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'sender' => $row['first_name'] . ' ' . $row['last_name'],
        'senderEmail' => $row['email_address'],
        'content' => $row['message_content'],
        'timestamp' => $row['timestamp']
    ];
}

echo json_encode(['messages' => $messages]);

$conn->close();
?>
