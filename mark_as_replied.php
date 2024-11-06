<?php
include "DBConn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];

    // Update the database to mark the message as replied
    $sql = "UPDATE message SET replied = 1 WHERE message_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);

    if ($stmt->execute()) {
        echo "Message marked as replied successfully.";
    } else {
        echo "Error updating message: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the messages page to refresh the view
    header("Location: messages.php");
    exit();
}
?>
