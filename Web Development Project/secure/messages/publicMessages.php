<?php
session_start();

if(!isset($_SESSION['userId']) || $_SESSION['admin'] == false) {
    header('Location: ../../index.php');
}

include("../conn.php");

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Internal CSS -->
    <link rel="stylesheet" href="../../stylesheet/ui.css">

    <title>Messages| wellbeing.</title>
</head>

<body class="bodyBackground">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">>

        <a class="navbar-brand" href="#">wellbeing.</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">home <span class="sr-only">(current)</span></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='../admin/adminProfile.php'>profile</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='../admin/adminGroups.php'>groups</a>
                </li>
                <li class='nav-item active dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>messages</a>
                <div class='dropdown-menu'>
                <a class='dropdown-item' href='publicMessages.php'>Public Messages</a>
                <a class='dropdown-item' href='userMessages.php'>User Messages</a>
                <a class='dropdown-item' href='groupMessages.php'>Group Messages</a>
                </div>
                </li>
             </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class='nav-item active'> <a class='nav-link'> Welcome, Guru </a> </li>
                <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='../login/signOut.php'>log out</a> </li>;
            </ul>
        </div>

    </nav>

    <!-- Main Content -->
    <div class="container-fluid" id="profileContainer">
        <div class='row justify-content-center'>
                    <div class='col-md-1'>
                        <img class='imgUser' src='../../img/wellbeingGuru.jpg'>
                    </div>
                    <div class='col-md-11'>
                        <h1 id='h1TitleStyle'>Public Messages</h1>
                    </div>
        </div>


                <?php
                    $publicMessagesQuery = "SELECT * FROM publicMessages";
                    $publicMessagesResult = $conn->query($publicMessagesQuery);

                    if (!$publicMessagesResult) {
                        echo "<p class='containerP'> Error Fetching Public Messages: $conn->error </p>";
                    } else {
                        if ($publicMessagesResult->num_rows == 0) {
                            echo "<div class='row profileRow'>
                            <div class='col'>
                                <div class='card mb-3 cardBlurred'>
                                <div class='card-body'>
                                <h1 class='card-title'> No messages found</h1>
                                <p class='card-text containerP'> Inbox Empty. </p>
                                </div>
                                </div>
                            </div>
                        </div>";
                        }

                        while ($message = $publicMessagesResult->fetch_assoc()) {
                                $name = $message['name'];
                                $email = $message['email'];
                                $publicMessage = $message['message'];

                                echo "<div class='row profileRow'>
                            <div class='col'>
                                <div class='card mb-3 cardBlurred'>
                                <div class='card-body'>
                                <h1 class='card-title'> $name </h1>
                      <p class='card-text containerP'> $publicMessage </p>
                      <div class='dropdown-divider'> </div>
                      <p class='card-text'> $email </p>
                      </div>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                ?>


    </div>

    <!-- Footer -->
    <div class="container-fluid footer">
    <p> All rights reserved. </p>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>

