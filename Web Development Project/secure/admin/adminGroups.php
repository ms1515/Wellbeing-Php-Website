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

    <title>Admin Groups| wellbeing.</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="adminProfile.php">profile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">groups</a>
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
                <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='../login/signOut.php'>log out</a> </li>

            </ul>
        </div>

    </nav>

    <!-- Main Content -->
    <div class="container-fluid" id="profileContainer">
        <div class="row">
            <div class="col-md-1">
                <img class="imgUser" src="../../img/wellbeingGuru.jpg">
            </div>
            <div class="col-md-11">
                <h1 id="h1TitleStyle"> Groups </h1>
            </div>
        </div>

        <!-- Groups -->
        <div class="row profileRow">
            <?php
            $fetchGroupsQuery = "SELECT * FROM `groups`";
            $fetchGroupsResult = $conn->query($fetchGroupsQuery);

            if (!$fetchGroupsResult) {
                echo "<p class='containerP'> Error in fetching groups: $conn->error";
            } else {
                if ($fetchGroupsResult->num_rows == 0) {
                    echo "<p class='containerP'> Zero groups Found";
                }
                while ($group = $fetchGroupsResult->fetch_assoc()) {
                    $groupId = $group['groupId'];
                    $groupName = $group['groupName'];
                    $description = $group['description'];
                    $imagePath = $group['imagePath'];
                    echo " <div class='col-md-3'>
                        <div class='card cardBlurred' style='width: 18rem;'>
                            <img class='card-img-top' src='../../img/$imagePath' alt='Card image cap'>
                            <div class='card-body'>
                              <h4 class='card-title'>$groupName</h4>
                              <p class='card-text'>$description</p>
                              <a href='adminGroupDetails.php?groupId=$groupId' class='btn btn-primary cancelButton'>Manage</a>
                              <a href='#' class='btn btn-primary'>Message</a>
                            </div>
                          </div>
                    </div>";
                }
            }
            ?>
        </div>


        <!-- Group Requests -->
        <div class="row profileRow">
            <div class="col-md-8">
                <h1>Group Requests</h1>
            </div>
        </div>
        <div class="row profileRow">

            <?php
            $fetchGroupRequestsQuery = "SELECT groupMembers.groupMemberId, users.firstName, users.lastName, users.email, groups.groupName 
                            FROM groupMembers
                            inner join 
                            users 
                            on groupMembers.userId = users.id 
                            inner join 
                            `groups`
                            on groupMembers.groupId = groups.groupId
                            WHERE groupMembers.approved = 0";
            $fetchGroupRequestsResult = $conn->query($fetchGroupRequestsQuery);

            if (!$fetchGroupRequestsResult) {
                echo " <div class='col-md-6'>
            <p class='containerP'> Error fetching group requests: $conn->error </p>
            </div>";
            } else {
                if ($fetchGroupRequestsResult->num_rows == 0) {
                    echo " <div class='col-md-6'>
                <p class='containerP'> No New Group Requests </p>
                </div>";
                }
                while ($groupRequest = $fetchGroupRequestsResult->fetch_assoc()) {
                    $groupMemberId = $groupRequest['groupMemberId'];
                    $userFullName = $groupRequest['firstName'] . " " . $groupRequest['lastName'];
                    $groupName = $groupRequest['groupName'];

                    echo " <div class='col-md-3'>
                <div class='card cardBlurred text-center' style='width: 18rem;'>
                    <div class='card-body'>
                        <h4 class='card-title'>$userFullName </h4>
                        <p class='card-text'>has requested to join</p>
                        <h4 class='card-title'>$groupName</h4>
                        <a href='../groups/approveJoinGroup.php?groupMemberId=$groupMemberId'
                            class='btn btn-primary approveButton'>Approve</a>
                        <a href='../groups/denyJoinGroup.php?groupMemberId=$groupMemberId'
                            class='btn btn-primary cancelButton'>Deny</a>
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