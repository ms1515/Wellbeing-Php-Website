<?php
session_start();
include('../conn.php');

if (!isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
}

$groupId = $_GET['groupId'];
$userId = $_SESSION['userId'];
$updateGroupMembershipQuery = "DELETE FROM groupMembers WHERE groupId=$groupId AND userId=$userId";
$updateGroupMembershipResult = $conn->query($updateGroupMembershipQuery);

if (!$updateGroupMembershipResult) {
    echo "Error Leaving the group member: $conn->error";
    return;
}

header('Location: ../groups.php');
?>