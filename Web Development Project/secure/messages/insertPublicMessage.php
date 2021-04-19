<?php
session_start();
include("../conn.php");
if (!isset($_POST['insertPublicMessageRequest'])) {
    header('Location: ../../index.php');
    return;
}
unset($_POST['insertPublicMessageRequest']);
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$message = $conn->real_escape_string($_POST['message']);

$insertMessageQuery = "INSERT INTO publicMessages(name, email, message) 
                      VALUES('$name', '$email', '$message')";

$result = $conn->query($insertMessageQuery);

if (!$result) {
    $_SESSION['insertPublicMessageFeedback'] = "Error sending message: $conn->error";
} else {
    $_SESSION['insertPublicMessageFeedback'] = "Successfully Sent Message";
}

header('Location: ../../contact.php');

?>