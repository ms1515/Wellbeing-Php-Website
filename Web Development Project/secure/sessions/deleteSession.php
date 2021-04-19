<?php
session_start();
include('../conn.php');

if (!isset($_SESSION["userId"])) {
    header("Location: ../../index.php");
    return;
}

$sessionToDelete = $_GET['sessionId'];
$deleteSessionQuery = "DELETE FROM sessions WHERE sessionId=$sessionToDelete";

$deleteSessionResult = $conn->query($deleteSessionQuery);

if (!$deleteSessionResult) {
    echo "Error deleting session: $conn->error";
} else {
    if ($_SESSION['admin'] == false) {
        header('Location: ../profile.php');
        return;
    }
    header('Location: ../admin/adminProfile.php');
}
?>