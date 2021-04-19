<?php
include('../conn.php');
session_start();

if (!isset($_POST['insertSessionRequest']) || !isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
    return;
}

$userId = $_SESSION['userId'];
$sessionType = $conn->real_escape_string($_POST['sessionType']);
$sessionDate = $conn->real_escape_string($_POST['dueDate']);
$sessionDueDate = date('Y-m-d', strtotime($sessionDate));
$insertSessionQuery = "INSERT INTO sessions(userId, type, date, approved) VALUES($userId,'$sessionType', '$sessionDueDate', 0)";

$insertSessionResult = $conn->query($insertSessionQuery);

if (!$insertSessionResult) {
    $_SESSION['insertSessionError'] = $conn->error;
    header('Location: addSession.php');
    return;
} 
header('Location: ../profile.php');


?>