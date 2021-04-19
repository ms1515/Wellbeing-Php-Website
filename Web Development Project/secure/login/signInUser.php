<?php
session_start();
include("../conn.php");

// If somebody tries to access this file via url
if (!isset($_POST['signInRequest'])) {
    header('Location: ../../signIn.php');
    return;
}
unset($_POST['signInRequest']);

$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

$checkUserQuery = "SELECT * from users WHERE email='$email'";
$checkUserResult = $conn->query($checkUserQuery);

if (!$checkUserResult) {
    $signInError = $conn->error;
    $_SESSION['signInError'] = $signInError;
    header("Location: ../../signIn.php");
    return;
}

$emailResults = $checkUserResult->num_rows;

if ($emailResults == 0) {
    $signInError = "You do not have an account with this email: $email.";
    $_SESSION['signInError'] = $signInError;
    header("Location: ../../signIn.php");
    return;
}

$encryptedPassword = sha1($password);
$checkUserPasswordQuery = "SELECT * from users WHERE email='$email' AND password='$encryptedPassword' ";

$checkUserPasswordResult = $conn->query($checkUserPasswordQuery);

if (!$checkUserPasswordResult) {
    $signInError = $conn->error;
    $_SESSION['signInError'] = $signInError;
    header("Location: ../../signIn.php");
    return;
}

$userResults = $checkUserPasswordResult->num_rows;

if ($userResults == 0) {
    $signInError = "The email password combination is incorrect.";
    $_SESSION['signInError'] = $signInError;
    header("Location: ../../signIn.php");
    return;
}

$signedInUser = $checkUserPasswordResult->fetch_assoc();

$_SESSION['userId'] = $signedInUser['id'];
$_SESSION['username'] = $signedInUser['firstName'];
($signedInUser['userType'] == 1) ?  $_SESSION['admin'] = true : $_SESSION['admin'] = false;
header("Location: ../../index.php");

?>