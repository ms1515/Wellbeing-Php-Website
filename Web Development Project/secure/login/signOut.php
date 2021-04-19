<?php
include('../conn.php');
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: ../../index.php");
} else {
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    unset($_SESSION['admin']);
    session_destroy();
    header("Location: ../../index.php");
}

?>