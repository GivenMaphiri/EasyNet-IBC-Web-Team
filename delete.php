<?php
include "DBConn.php"; // Connect to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];

    // Prepare SQL to delete the message
    $sql = "DELETE FROM message WHERE message_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);

    if ($stmt->execute()) {
        echo "Message deleted successfully.";
    } else {
        echo "Error deleting message: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the messages page to see updated list
    header("Location: messages.php");
    exit();
}
?>