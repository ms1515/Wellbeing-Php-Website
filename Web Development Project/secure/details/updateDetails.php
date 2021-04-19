<?php
session_start();
include("../conn.php");

if (!isset($_POST['updateDetailsRequest'])) {
    header('Location: ../../index.php');
    return;
}

unset($_POST['updateDetailsRequest']);

$currentUserId = $_SESSION['userId'];
$address = $conn->real_escape_string($_POST['address']);
$postCode = $conn->real_escape_string($_POST['postCode']);
$city = $conn->real_escape_string($_POST['city']);
$country = $conn->real_escape_string($_POST['country']);
$phone = $conn->real_escape_string($_POST['phone']);

$updateUserDetailsQuery = "UPDATE userDetails SET streetAddress='$address', postCode='$postCode', city='$city', country='$country', phone='$phone' WHERE userId=$currentUserId";
$updateUserDetailsResult = $conn->query($updateUserDetailsQuery);

if (!$updateUserDetailsResult) {
    $_SESSION['updateDetailsError'] = $conn->error;
    header('Location: editDetails.php');
    return;
}

header('Location: ../profile.php');

?>