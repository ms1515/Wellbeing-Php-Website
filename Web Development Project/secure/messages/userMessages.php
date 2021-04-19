<?php
session_start();

if (!isset($_SESSION['userId'])) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Internal CSS -->
    <link rel="stylesheet" href="../../stylesheet/ui.css">

    <title>Messages| wellbeing.</title>
</head>

<body class="bodyBackground">

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
                <?php
                if ($_SESSION['admin'] == false) {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='../profile.php'>profile</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='../groups.php'>groups</a>
                    </li>
                    <li class='nav-item active dropdown'>
                    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>messages</a>
                    <div class='dropdown-menu'>
                    <a class='dropdown-item' href='userMessages.php'>User Messages</a>
                    <a class='dropdown-item' href='groupMessages.php'>Group Messages</a>
                    </div>
                    </li> ";
                } else {
                    echo "<li class='nav-item'>
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
                </li>";
                }
                ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                if ($_SESSION['admin'] == false) {
                    $username = $_SESSION['username'];
                    echo "<li class='nav-item active'> <a class='nav-link'> Hi, $username </a> </li>
                            <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='../login/signOut.php'>log out</a> </li>";
                } else {
                    echo " <li class='nav-item active'> <a class='nav-link'> Welcome, Guru </a> </li>
                        <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='../login/signOut.php'>log out</a> </li>";
                }
                ?>
            </ul>
        </div>

    </nav>

    <!-- Main Content -->
    <div class="container-fluid" id="profileContainer">

        
        <?php

        // Title Stuff
        if ($_SESSION['admin'] == false) {
            $username = $_SESSION['username'];
            echo "  <div class='row'>
                <div class='col-md-10'>
                <h1 id='h1TitleStyle'>Message Users</h1>
                </div>
                </div>";

            $findAdminUserQuery = "SELECT * FROM users WHERE userType=1";
            $findAdminUserResult = $conn->query($findAdminUserQuery);

            if (!$findAdminUserResult || $findAdminUserResult->num_rows == 0) {
                echo "<p class='containerP'> Error Finding admin user: $conn->error </p>";
            } else {
                $admin = $findAdminUserResult->fetch_assoc();
                $adminId = $admin['id'];
                $adminEmail = $admin['email'];
                echo "<div class='row profileRow'>
                      <div class='col'>
                        <div class='card mb-3 cardBlurred'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-md-1'>
                                    <img class='imgUser' src='../../img/wellbeingGuru.jpg'>
                                </div>
                                <div class='col-md-6'>
                                    <h1>The Wellbeing Guru</h1>
                                    <p class='card-text'> $adminEmail </p>
                                </div>
                                <div class='col-md-2'>
                                    <a href='messageUser.php?userId=$adminId' class='btn btn-primary approveButton'>Message</a>
                                </div>
                            </div>
                        </div>
                        </div>
                     </div>
                    </div>";
            }
        } else {
            echo "<div class='row justify-content-center'>
                <div class='col-md-1'>
                    <img class='imgUser' src='../../img/wellbeingGuru.jpg'>
                </div>
                <div class='col-md-11'>
                    <h1 id='h1TitleStyle'>Message Users</h1>
                </div>
            </div>";
        }

        $currentUserId = $_SESSION['userId'];
        $fetchAllUsersQuery = "SELECT * FROM users WHERE userType=2 AND id !=$currentUserId";
        $fetchAllUsersResult = $conn->query($fetchAllUsersQuery);

        if (!$fetchAllUsersResult) {
            echo "<p class='containerP'> Error Finding users: $conn->error </p>";
        } else {

            if ($fetchAllUsersResult->num_rows == 0) {
                echo "<p class='containerP'> No Users Found </p>";
            }
            while($user = $fetchAllUsersResult->fetch_assoc()) {
            $userId = $user['id'];
            $userName = $user['firstName']." ".$user['lastName'];
            $userEmail = $user['email'];
            echo "<div class='row profileRow'>
                  <div class='col'>
                    <div class='card mb-3 cardBlurred'>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-md-7'>
                                <h1>$userName</h1>
                                <p class='card-text'> $userEmail </p>
                            </div>
                            <div class='col-md-2'>
                                <a href='messageUser.php?userId=$userId' class='btn btn-primary approveButton'>Message</a>
                            </div>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>