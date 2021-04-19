<?php
session_start();
include("../conn.php");
if (!isset($_POST['insertUserMessageRequest']) || !isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
    return;
}

$currentUserId = $_SESSION['userId'];
$recipientUserId = $conn->real_escape_string($_POST['recipientUserId']);
$messageToInsert = $conn->real_escape_string($_POST['message']);

$insertUserMessageQuery = "INSERT INTO userMessages(user1Id, user2Id, message) VALUES($currentUserId, $recipientUserId, '$messageToInsert')";
$insertUserMessageResult = $conn->query($insertUserMessageQuery);

if (!$insertUserMessageResult) {
    $_SESSION['insertMessageError'] = $conn->error;
}
$location = "Location: messageUser.php?userId=$recipientUserId";
header($location);
return;
?>