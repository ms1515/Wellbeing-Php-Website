<?php
session_start();
include('../conn.php');

if (!isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
    return;
}

$groupId = $_GET['groupId'];
$currentUserId = $_SESSION['userId'];

$requestJoinGroupQuery = "INSERT INTO groupMembers(userId, groupId, approved) VALUES($currentUserId,$groupId,0)";
$requestJoinGroupResult = $conn->query($requestJoinGroupQuery);

if (!$requestJoinGroupResult) {
    echo "Error in Request Join Group: $conn->error";
    return;
} 

// Success
header('Location: ../groups.php');
?>