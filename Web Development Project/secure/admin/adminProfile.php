<?php
session_start();
if (!isset($_SESSION['userId']) || $_SESSION['admin'] == false) {
    header('Location: ../../index.php');
    return;
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Internal CSS -->
    <link rel="stylesheet" href="../../stylesheet/ui.css">

    <title>Admin Profile| wellbeing.</title>
</head>

<body class="bodyBackground">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">>

        <a class="navbar-brand" href="#">wellbeing.</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminGroups.php">groups</a>
                </li>
                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>messages</a>
                <div class='dropdown-menu'>
                <a class='dropdown-item' href='../messages/publicMessages.php'>Public Messages</a>
                <a class='dropdown-item' href='../messages/userMessages.php'>User Messages</a>
                <a class='dropdown-item' href='../messages/groupMessages.php'>Group Messages</a>
                </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class='nav-item active'> <a class='nav-link'> Welcome, Guru </a> </li>
                <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='../login/signOut.php'>log out</a> </li>";

            </ul>
        </div>

    </nav>

    <!-- Main Content -->
    <div class="container-fluid" id="profileContainer">
        <div class="row justify-content-center">
            <div class="col-md-1">
                <img class="imgUser" src="../../img/wellbeingGuru.jpg">
            </div>
            <div class="col-md-11">
                <h1 id="h1TitleStyle">The Wellbeing Guru</h1>
            </div>
        </div>

        <!-- Sessions Section -->
        <div class="row profileRow">
            <div class="col-md-8">
                <h1>Confirmed Sessions</h1>
            </div>
        </div>
        <div class="row profileRow">
            <?php
            $fetchApprovedSessionsQuery = "SELECT * FROM sessions WHERE approved=1";
            $fetchApprovedSessionsResult = $conn->query($fetchApprovedSessionsQuery);

            if (!$fetchApprovedSessionsResult) {
                echo " <div class='col-md-12'>
                <p class='containerP'> Unable to fetch Sessions: $conn->error </p>
                </div> ";
            } else {

                if ($fetchApprovedSessionsResult->num_rows == 0) {
                    echo " <div class='col-md-12'>
                    <p class='containerP'> You have no confirmed sessions.</p>
                    </div>";
                }

                while ($approvedSession = $fetchApprovedSessionsResult->fetch_assoc()) {

                    $sessionId = $approvedSession['sessionId'];
                    $clientId = $approvedSession['userId'];
                    $sessionType = $approvedSession['type'];
                    $sessionDate = $approvedSession['date'];

                    $fetchClientQuery = "SELECT * FROM users WHERE id=$clientId";
                    $fetchClientResult = $conn->query($fetchClientQuery);

                    if (!$fetchClientResult) {
                        $clientName = "Error Fetching Client Name";
                    } else {
                        $client = $fetchClientResult->fetch_assoc();
                        $clientName = $client['firstName']." ".$client['lastName'];
                        $clientEmail = $client['email'];
                    }

                    echo " <div class='col-md-3'>
                                    <div class='card cardBlurred text-center' style='width: 18rem;'>
                                        <div class='card-body'>
                                            <h4 class='card-title'>Date: $sessionDate</h4>
                                            <h5 class='card-text'>Type: $sessionType</h5>
                                            <p>Client: $clientName </p>
                                            <p> $clientEmail </p>
                                            <a href='../sessions/deleteSession.php?sessionId=$sessionId' class='btn btn-primary cancelButton'>Cancel</a>
                                        </div>
                                    </div>
                                </div> ";
                }
            }
            ?>
        </div>

        <!-- Pending Sessions Section -->
        <div class="row profileRow">
            <div class="col-md-8">
                <h1>Pending Sessions</h1>
            </div>
        </div>
        <div class="row profileRow">
            <?php

            $fetchPendingSessionsQuery = "SELECT users.firstName, users.lastName, users.email, sessions.sessionId, sessions.type, sessions.date
             FROM sessions
             inner join
             users
             on sessions.userId = users.id
             WHERE approved=0";

            $fetchPendingSessionsResult = $conn->query($fetchPendingSessionsQuery);

            if (!$fetchPendingSessionsResult) {
                echo " <div class='col-md-12'>
                <p class='containerP'> Unable to fetch Sessions: $conn->error </p>
                </div>";
            } else {

                if ($fetchPendingSessionsResult->num_rows == 0) {
                    echo " <div class='col-md-12'>
                    <p class='containerP'> You have no pending sessions.</p>
                    </div>";
                }

                while ($userSession = $fetchPendingSessionsResult->fetch_assoc()) {

                    $sessionId = $userSession['sessionId'];
                    $sessionType = $userSession['type'];
                    $sessionDate = $userSession['date'];
                    $clientName = $userSession['firstName']." ".$userSession['lastName'];
                    $clientEmail = $userSession['email'];

                    echo " <div class='col-md-3'>
                                    <div class='card cardBlurred text-center' style='width: 18rem;'>
                                        <div class='card-body'>
                                            <h4 class='card-title'>$sessionDate</h4>
                                            <h5 class='card-text'>$sessionType</h5>
                                            <p>Client: $clientName </p>
                                            <p> $clientEmail </p>
                                            <a href='../sessions/approveSession.php?sessionId=$sessionId' class='btn btn-primary approveButton'>Approve</a>
                                            <a href='../sessions/deleteSession.php?sessionId=$sessionId' class='btn btn-primary cancelButton'>Cancel</a>
                                        </div>
                                    </div>
                                </div> ";
                }
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid footer">
    <p> All rights reserved. </p>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>