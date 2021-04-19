<?php
session_start();
if (!isset($_SESSION['userId']) || $_SESSION['admin'] == true) {
    header('Location: ../index.php');
}
include("conn.php");

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
    <link rel="stylesheet" href="../stylesheet/ui.css">

    <title>Profile| wellbeing.</title>
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
                    <a class="nav-link" href="../index.php">home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="groups.php">groups</a>
                </li>
                <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>messages</a>
                <div class='dropdown-menu'>
                <a class='dropdown-item' href='messages/userMessages.php'>User Messages</a>
                <a class='dropdown-item' href='messages/groupMessages.php'>Group Messages</a>
                </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                $username = $_SESSION['username'];
                echo "<li class='nav-item active'> <a class='nav-link'> Hi, $username </a> </li>
                        <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='login/signOut.php'>log out</a> </li>";

                ?>
            </ul>
        </div>

    </nav>

    <!-- Main Content -->
    <div class="container-fluid" id="profileContainer">
        <h1 id="h1TitleStyle">Welcome <?php echo $_SESSION['username']; ?></h1>

        <!-- Details Section -->
        <div class="row profileRow">
            <div class="col-md-8">
                <h1>Your Details</h1>
            </div>
        </div>

        <div class="row profileRow">
                <?php
                $currentUserId = $_SESSION['userId'];
                $fetchCurrentUserDetailsQuery = "SELECT * FROM userDetails WHERE userId=$currentUserId";
                $fetchCurrentUserDetailsResult = $conn->query($fetchCurrentUserDetailsQuery);

                if (!$fetchCurrentUserDetailsResult) {
                    echo " <div class='col-md-8'>
                    <p class='containerP'> Unable to fetch Details: $conn->error
                            </p>
                            </div>";
                } else {

                    if ($fetchCurrentUserDetailsResult->num_rows == 0) {
                        $address = "No Address Provided";
                        $address = "No Address Provided";
                        $postCode = "No Post Code Provided";
                        $city = "No City Provided";
                        $country = "No Country Provided";
                        $phone = "No Phone Provided";
                        echo "
                        <div class='card detailsCardBlurred col-md-10'> 
                        <div class='row'>

                        <div class='col-md-4'>
                        <label class='control-label'>Street Address</label>
                        <p class='containerP'> $address </p>
                        <label class='control-label'>Post Code</label>
                        <p class='containerP'> $postCode </p>
                        <label class='control-label'>City</label>
                        <p class='containerP'> $city </p>
                        </div>

                        <div class='col-md-4'>
                        <label class='control-label'> Country </label>
                        <p class='containerP'> $country </p>
                        <label class='control-label'> Phone Number </label>
                        <p class='containerP'> $phone </p>
                        </div>

                        <div class='col-md-2'>
                        <a href='details/addDetails.php' class='btn btn-primary'>Insert Details</a>
                        </div> 

                        </div> 
                        </div>
                        ";
                    }
                    while ($currentUserDetails = $fetchCurrentUserDetailsResult->fetch_assoc()) {
                        $address = $currentUserDetails['streetAddress'];
                        $postCode = $currentUserDetails['postCode'];
                        $city = $currentUserDetails['city'];
                        $country = $currentUserDetails['country'];
                        $phone = $currentUserDetails['phone'];
                        echo "
                        <div class='card detailsCardBlurred col-md-10'> 
                        <div class='row'>

                        <div class='col-md-4'>
                        <label class='control-label'>Street Address</label>
                        <p class='containerP'> $address </p>
                        <label class='control-label'>Post Code</label>
                        <p class='containerP'> $postCode </p>
                        <label class='control-label'>City</label>
                        <p class='containerP'> $city </p>
                        </div>

                        <div class='col-md-4'>
                        <label class='control-label'> Country </label>
                        <p class='containerP'> $country </p>
                        <label class='control-label'> Phone Number </label>
                        <p class='containerP'> $phone </p>
                        </div>

                        <div class='col-md-2'>
                        <a href='details/editDetails.php' class='btn btn-primary'>Edit Details</a>
                        </div> 

                        </div> 
                        </div>
                        ";
                    }
                }
                ?>
            </div>

            <!-- Sessions Section -->
            <div class="row profileRow">
                <div class="col-md-8">
                    <h1>Your Upcoming Sessions</h1>
                </div>
            </div>
            <div class="row profileRow">
                <?php
                $fetchCurrentUserSessionsQuery = "SELECT * FROM sessions WHERE userId=$currentUserId AND approved=1";
                $fetchCurrentUserSessionsResult = $conn->query($fetchCurrentUserSessionsQuery);

                if (!$fetchCurrentUserSessionsResult) {
                    echo " <div class='col-md-12'>
                <p class='containerP'> Unable to fetch upcoming Sessions: $conn->error </p>
                </div> ";
                } else {

                    if ($fetchCurrentUserSessionsResult->num_rows == 0) {
                        echo " <div class='col-md-12'>
                    <p class='containerP'> You have no upcoming sessions. </p>
                    </div> ";
                    }

                    while ($currentUserSession = $fetchCurrentUserSessionsResult->fetch_assoc()) {

                        $userSessionId = $currentUserSession['sessionId'];
                        $userSessionType = $currentUserSession['type'];
                        $userSessionDate = $currentUserSession['date'];

                        echo " <div class='col-md-3'>
                                    <div class='card cardBlurred text-center' style='width: 18rem;'>
                                        <div class='card-body'>
                                            <h4 class='card-title'>Date: $userSessionDate</h4>
                                            <h5 class='card-text'>Type: $userSessionType</h5>
                                            <a href='sessions/deleteSession.php?sessionId=$userSessionId' class='btn btn-primary cancelButton'>Cancel Session</a>
                                        </div>
                                    </div>
                                </div> ";
                    }
                }
                ?>
                <div class='col-md-3'>
                    <div class='card cardBlurred text-center' style='width: 18rem;'>
                        <div class='card-body'>
                            <h4 class='card-title'>Book A new Session</h4>
                            <p class='card-text'>with the wellbeing Guru</p>
                            <a href='sessions/addSession.php' class='btn btn-primary'>Book</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Sessions Section -->
            <div class="row profileRow">
                <div class="col-md-8">
                    <h1>Your Pending Sessions</h1>
                </div>
            </div>
            <div class="row profileRow">
                <?php
                $fetchCurrentUserSessionsQuery = "SELECT * FROM sessions WHERE userId=$currentUserId AND approved=0";
                $fetchCurrentUserSessionsResult = $conn->query($fetchCurrentUserSessionsQuery);

                if (!$fetchCurrentUserSessionsResult) {
                    echo " <div class='col-md-12'>
                <p class='containerP'> Unable to fetch pending Sessions: $conn->error </p>
                </div>";
                } else {

                    if ($fetchCurrentUserSessionsResult->num_rows == 0) {
                        echo " <div class='col-md-8'>
                    <p class='containerP'> You have no pending sessions.
                    </div> ";
                    }

                    while ($currentUserSession = $fetchCurrentUserSessionsResult->fetch_assoc()) {

                        $userSessionId = $currentUserSession['sessionId'];
                        $userSessionType = $currentUserSession['type'];
                        $userSessionDate = $currentUserSession['date'];

                        echo " <div class='col-md-3'>
                                    <div class='card cardBlurred text-center' style='width: 18rem;'>
                                        <div class='card-body'>
                                            <h4 class='card-title'>$userSessionDate</h4>
                                            <p class='card-text'>$userSessionType</p>
                                            <a href='sessions/editSession.php?sessionId=$userSessionId' class='btn btn-primary approveButton'>Edit</a>
                                            <a href='sessions/deleteSession.php?sessionId=$userSessionId' class='btn btn-primary cancelButton'>Cancel</a>
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