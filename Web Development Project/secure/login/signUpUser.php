<?php
session_start();
include("../conn.php");

// If somebody tries to access this file via url
if (!isset($_POST['signUpRequest'])) {
    header('Location: ../../signIn.php');
    return;
}
unset($_POST['signUpRequest']);

$firstName = $conn->real_escape_string($_POST['firstName']);
$lastName = $conn->real_escape_string($_POST['lastName']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

$checkUserQuery = "SELECT * from users WHERE email='$email'";

$checkUserResult = $conn->query($checkUserQuery);

if (!$checkUserResult) {
    $signUpError = $conn->error;
    $_SESSION['signUpError'] = $signUpError;
    header("Location: ../../signUp.php");
    return;
}

$results = $checkUserResult->num_rows;

if ($results > 0) {
    $signUpError = "You already have an account with this email: $email.";
    $_SESSION['signUpError'] = $signUpError;
    header("Location: ../../signUp.php");
    return;
} else {
    echo "\nYou may register.";
}

$encryptedPassword = sha1($password);
$insertUserQuery = "INSERT INTO users(firstName, lastName, email, password, userType) VALUES ('$firstName','$lastName', '$email', '$encryptedPassword', 2)";
$insertUserResult = $conn->query($insertUserQuery);

if (!$insertUserResult) {
    $signUpError = $conn->error;
    $_SESSION['signUpError'] = $signUpError;
    header("Location: ../../signUp.php");
    return;
} 

$_SESSION['userId'] = $conn->insert_id; 
$_SESSION['username'] = $firstName;
$_SESSION['admin'] = false;
header("Location: ../../index.php");


?>