<?php
session_start();
include("../conn.php");

if (!isset($_POST['insertDetailsRequest'])) {
    header('Location: ../../index.php');
    return;
}

unset($_POST['insertDetailsRequest']);

$currentUserId = $_SESSION['userId'];
$address = $conn->real_escape_string($_POST['address']);
$postCode = $conn->real_escape_string($_POST['postCode']);
$city = $conn->real_escape_string($_POST['city']);
$country = $conn->real_escape_string($_POST['country']);
$phone = $conn->real_escape_string($_POST['phone']);

$insertUserDetailsQuery = "INSERT INTO userDetails(userId, streetAddress, postCode, city, country, phone) VALUES($currentUserId,'$address', '$postCode', '$city', '$country', '$phone')";
$insertUserDetailsResult = $conn->query($insertUserDetailsQuery);

if (!$insertUserDetailsResult) {
    $_SESSION['insertDetailsError'] = $conn->error;
    header('Location: addDetails.php');
    return;
}

header('Location: ../profile.php');

?>