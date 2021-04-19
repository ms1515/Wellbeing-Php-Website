<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
}

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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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

        include("../conn.php");

        $currentUserId = $_SESSION['userId'];
        $groupId = $_GET['groupId'];
        $getGroupQuery = "SELECT * FROM `groups` WHERE groups.groupId = $groupId";
        $getGroupResult = $conn->query($getGroupQuery);

        if (!$getGroupResult) {
            echo "<p class='containerP error'> Error fetching details for recipient group: $conn->error </p>";
        } else {
            $group = $getGroupResult->fetch_assoc();
            $groupName = $group['groupName'];
        }

        echo "  <div class='row'>
                <div class='col-md-10'>
                <h1 id='h1TitleStyle'>$groupName</h1>
                </div>
                </div>";

        $fetchGroupMessagesQuery = "SELECT users.firstName, users.email, groupMessages.message 
                                    FROM groupMessages INNER JOIN
                                    users ON 
                                    groupMessages.userId = users.id 
                                    WHERE groupMessages.groupId = $groupId";

        $fetchGroupMessagesResult = $conn->query($fetchGroupMessagesQuery);

        if (!$fetchGroupMessagesResult) {
            echo "<p class='containerP error'> Error Obtaining messages for users: $conn->error </p>";
        } else {
            if ($fetchGroupMessagesResult->num_rows == 0) {
                echo "<div class='row profileRow'>
        <div class='col'>
            <div class='card mb-3 cardBlurred'>
            <div class='card-body'>
            <p class='card-text containerP'> You have yet to begin a conversation with the Group: $groupName </p>
            </div>
            </div>
        </div>
    </div>";
            }

            while ($message = $fetchGroupMessagesResult->fetch_assoc()) {
                $userName = $message['firstName'];
                $userEmail = $message['email'];
                $userMessage = $message['message'];

                echo "<div class='row profileRow'>
                        <div class='col'>
                            <div class='card mb-3 cardBlurred'>
                            <div class='card-body'>
                            <p class='card-text containerP'> $userMessage </p>
                            <div class='dropdown-divider'> </div>
                            <p class='card-text'>$userName, $userEmail </p>
                            </div>
                            </div>
                        </div>
                    </div>";
            }
        }
        ?>

    </div>

    <div class='row profileRow'>
        <div class='col'>
            <div class='card mb-3 cardBlurred'>
                <div class='card-body'>
                    <form class="needs-validation" action=<?php echo "insertGroupMessage.php"; ?> method="POST" novalidate>
                        <div class="input-group mb-3 form-group">
                            <input type="text" hidden=true name="recipientGroupId" value=<?php echo $groupId; ?>>
                            <input type="text" class="form-control" placeholder="Enter message" name="message" aria-describedby="basic-addon2" required>
                            <div class="invalid-feedback">
                                Please enter a message to send.
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary approveButton" type="submit" name="insertGroupMessageRequest">Send Message</button>
                            </div>
                        </div>
                    </form>
                    <p id="errorMessage">
                        <?php
                        if (isset($_SESSION['insertMessageError'])) {
                            $errorMessage = $_SESSION['insertMessageError'];
                            unset($_SESSION['insertMessageError']);
                            echo "Error sending message: $errorMessage";
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid footer">
        <p> All rights reserved. </p>
    </div>

    <!-- Validation Script -->
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</body>

</html>