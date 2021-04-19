<?php
session_start();
include('../conn.php');

if ($_SESSION['admin'] == false || !isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
}

$groupId = $_GET['groupId'];
$groupMemberId = $_GET['groupMemberId'];

$updateGroupMembershipQuery = "DELETE FROM groupMembers WHERE groupMemberId=$groupMemberId";
$updateGroupMembershipResult = $conn->query($updateGroupMembershipQuery);

if (!$updateGroupMembershipResult) {
    echo "Error deleting group member: $conn->error";
    return;
}
$location = "Location: ../admin/adminGroupDetails.php?groupId=$groupId";
header($location);

?>