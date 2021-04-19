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

    <title>Groups| wellbeing.</title>
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
                    <a class="nav-link" href="../index.php">home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">profile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">groups</a>
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
        <div class="row">
            <div class="col-md-10">
                <h1 id="h1TitleStyle">Groups for <?php echo $_SESSION['username']; ?></h1>
            </div>
        </div>

        <div class="row profileRow">
            <?php
            $fetchGroupsQuery = "SELECT * FROM groups";
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
                    $currentUserId = $_SESSION['userId'];

                    $isCurrentUserMemberQuery = "SELECT * FROM groupMembers WHERE groupId=$groupId AND userId=$currentUserId";
                    $isCurrentUserMemberResult = $conn->query($isCurrentUserMemberQuery);

                    if (!$isCurrentUserMemberResult) {
                        echo "<p class='containerP'> Error retreiving user membership details $conn->error </p>";
                    } else {
                        if ($isCurrentUserMemberResult->num_rows == 0) {
                            $groupActionFile = "groups/requestJoinGroup.php?groupId=$groupId";
                            $groupActionTitle = "Join";
                        }
                        while ($currentUserMember = $isCurrentUserMemberResult->fetch_assoc()) {
                            $currentUserMembershipStatus = $currentUserMember['approved'];
                            if ($currentUserMembershipStatus == 0) {
                                $groupActionFile = "#";
                                $groupActionTitle = "Pending";
                            } else {
                                $groupActionFile = "groups/leaveGroup.php?groupId=$groupId";
                                $groupActionTitle = "Leave Group";
                            }
                        }
                    }
                    
                    echo " <div class='col-md-3'>
                        <div class='card cardBlurred' style='width: 18rem;'>
                            <img class='card-img-top' src='../img/$imagePath' alt='Card image cap'>
                            <div class='card-body'>
                              <h4 class='card-title'>$groupName</h4>
                              <p class='card-text'>$description</p>
                              <a href='groupDetails.php?groupId=$groupId' class='btn btn-primary'>See Details</a>
                              <a href='$groupActionFile' class='btn btn-primary approveButton'>$groupActionTitle</a>
                            </div>
                          </div>
                    </div>";
                }
            }
            ?>
        </div>

    </div>

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