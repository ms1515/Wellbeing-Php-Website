<?php
session_start();
include('../conn.php');

if ($_SESSION['admin'] == false || !isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
}

$groupMemberId = $_GET['groupMemberId'];

$updateGroupMembershipQuery = "UPDATE groupMembers SET approved=1 WHERE groupMemberId=$groupMemberId";
$updateGroupMembershipResult = $conn->query($updateGroupMembershipQuery);

if (!$updateGroupMembershipResult) {
    echo "Error updating group membership: $conn->error";
    return;
}

header('Location: ../admin/adminGroups.php');

?>