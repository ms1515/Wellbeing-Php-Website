<?php
session_start();
include("../conn.php");
if (!isset($_POST['insertGroupMessageRequest']) || !isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
    return;
}

$currentUserId = $_SESSION['userId'];
$recipientGroupId = $conn->real_escape_string($_POST['recipientGroupId']);
$messageToInsert = $conn->real_escape_string($_POST['message']);

$insertGroupMessageQuery = "INSERT INTO groupMessages(groupId, userId, message) VALUES($recipientGroupId, $currentUserId,'$messageToInsert')";
$insertGroupMessageResult = $conn->query($insertGroupMessageQuery);

if (!$insertGroupMessageResult) {
    $_SESSION['insertMessageError'] = $conn->error;
}
$location = "Location: messageGroup.php?groupId=$recipientGroupId";
header($location);
return;
?>