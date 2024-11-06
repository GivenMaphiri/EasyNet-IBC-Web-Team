<?php
include "DBConn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];

    // Update message as replied
    $sql = "UPDATE message SET replied = 1 WHERE message_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect back to the messages page
    header("Location: messages.php");
    exit();
}
?>
