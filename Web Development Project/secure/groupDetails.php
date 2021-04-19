<!-- <?php
session_start();

if(!isset($_SESSION['userId'])) {
    header('Location: ../index.php');
}
include("conn.php");

?> -->
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
    <link rel="stylesheet" href="../stylesheet/ui.css">

    <title>Group Details| wellbeing.</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">profile</a>
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
    <div class="container-fluid">

        <div class="row containerRow">
            <div class="col">
                <div class="card mb-3 cardBlurred">

                    <?php
                        $groupId = $_GET['groupId'];
                        $fetchGroupQuery = "SELECT * FROM groups WHERE groupId=$groupId";
                        $fetchGroupResult = $conn->query($fetchGroupQuery);

                        if (!$fetchGroupResult) {
                            $groupName = "No Group Found";
                            $groupDescription = "Unable to fetch group: $conn->error";
                            $groupImagePath = "";
                        } else {
                            $group = $fetchGroupResult->fetch_assoc();
                            $groupName = $group['groupName']; 
                            $groupDescription = $group['description'];
                            $groupImagePath = $group['imagePath'];
                        }
                    ?>

                    <img class="card-img-top" src=<?php echo "../img/$groupImagePath"; ?> alt="Card image cap">
                    <div class="card-body">
                      <h1 class="card-title"><?php echo $groupName; ?></h1>
                      <p class="card-text containerP"> <?php echo $groupDescription; ?> </p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      <h2 class='card-text'> Members </h2>
                      <div class="dropdown-divider"> </div>
                      <?php
                        $groupId = $_GET['groupId'];
                        $fetchGroupMembersQuery = "SELECT groupMembers.groupMemberId, users.firstName, users.lastName, users.email
                        FROM groupMembers 
                        inner join 
                        users 
                        on groupMembers.userId = users.id 
                        WHERE groupMembers.approved = 1 AND groupMembers.groupId = $groupId";
                        $fetchGroupMembersResult = $conn->query($fetchGroupMembersQuery);

                        if (!$fetchGroupMembersResult) {
                            echo "<div class='row'>
                            <div class='col'>
                              <p class='containerP'> Error in fetching group members: $conn->error</p>
                            </div>
                            </div>";
                        } else {
                            if ($fetchGroupMembersResult->num_rows == 0) {
                                echo "<div class='row'>
                                <div class='col'>
                                  <p class='containerP'> This group has no members. </p>
                                </div>
                                </div>";
                            }

                            while ($groupMember = $fetchGroupMembersResult->fetch_assoc()) {
                                $memberId = $groupMember['groupMemberId'];
                                $memberName = $groupMember['firstName']." ".$groupMember['lastName'];
                                $memberEmail = $groupMember['email'];
                                echo "<div class='row'>
                          <div class='col'>
                            <h3> $memberName</h3>
                            <p> $memberEmail</p>
                          </div>
                      </div>";
                            }
                        }
                      ?>
                    </div>
                  </div>
            </div>
        </div>

    </div>

</body>
