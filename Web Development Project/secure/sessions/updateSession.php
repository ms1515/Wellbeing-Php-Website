<?php
include('../conn.php');

if (!isset($_POST['updateSessionRequest'])) {
    header('Location: ../../index.php');
    return;
}

$sessionId = $conn->real_escape_string($_POST['sessionId']);
$sessionType = $conn->real_escape_string($_POST['sessionType']);
$sessionDate = $conn->real_escape_string($_POST['dueDate']);
$sessionDueDate = date('Y-m-d', strtotime($sessionDate));
$updateSessionQuery = "UPDATE sessions SET type='$sessionType', date='$sessionDueDate' WHERE sessionId=$sessionId";

$updateSessionResult = $conn->query($updateSessionQuery);

if (!$updateSessionResult) {
    $_SESSION['updateSessionError'] = $conn->error;
    header('Location: editSession.php');
    return;
} 
header('Location: ../profile.php');

?>