<?php
session_start();
include('../conn.php');

if (!isset($_SESSION['userId']) || $_SESSION['admin'] == false) {
    header('Location: ../../index.php');
    return;
}

$sessionId = $_GET['sessionId'];
$updateSessionQuery = "UPDATE sessions SET approved=1 WHERE sessionId=$sessionId";

$updateSessionResult = $conn->query($updateSessionQuery);

if (!$updateSessionResult) {
    echo "Error Approving Session: $conn->error";
} else {
    header('Location: ../admin/adminProfile.php');
}

?>