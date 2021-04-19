<?php
session_start();
include("secure/conn.php");

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
    <link rel="stylesheet" href="stylesheet/ui.css">

    <title>Home| wellbeing.</title>
</head>

<body>

    <!-- Nav Bar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md navbar-dark bg-dark">>
        <a class="navbar-brand" href="#">wellbeing.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">home <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if (isset($_SESSION['userId']) && $_SESSION['admin'] == false) {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='secure/profile.php'>profile</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='secure/groups.php'>groups</a>
                    </li>
                    <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>messages</a>
                    <div class='dropdown-menu'>
                    <a class='dropdown-item' href='secure/messages/userMessages.php'>User Messages</a>
                    <a class='dropdown-item' href='secure/messages/groupMessages.php'>Group Messages</a>
                    </div>
                    </li>";
                } else if (isset($_SESSION['userId']) && $_SESSION['admin'] == true) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='secure/admin/adminProfile.php'>profile</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='secure/admin/adminGroups.php'>groups</a>
                </li>
                <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>messages</a>
                    <div class='dropdown-menu'>
                    <a class='dropdown-item' href='secure/messages/publicMessages.php'>Public Messages</a>
                    <a class='dropdown-item' href='secure/messages/userMessages.php'>User Messages</a>
                    <a class='dropdown-item' href='secure/messages/groupMessages.php'>Group Messages</a>
                    </div>
                    </li>";
                } else {
                    echo "<li class='nav-item'> <a class='nav-link' href='contact.php'>contact</a> </li>";
                }
                ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <?php
                if (isset($_SESSION['userId']) && $_SESSION['admin'] == false) {
                    $username = $_SESSION['username'];
                    echo "<li class='nav-item active'> <a class='nav-link'> Hi, $username </a> </li>
                        <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='secure/login/signOut.php'>log out</a> </li>";
                } else if (isset($_SESSION['userId']) && $_SESSION['admin'] == true) {
                    echo "<li class='nav-item active'> <a class='nav-link'> Welcome, Guru </a> </li>
                        <li class='nav-item'> <a class='nav-link' id='navLoginButton' href='secure/login/signOut.php'>log out</a> </li>";
                } else {
                    echo "<li> <a class='nav-link' id='navLoginButton' href='signIn.php'>login </a> </li>";
                }
                ?>

            </ul>
        </div>

    </nav>

    <!-- First Container -->
    <div class="container-fluid" id="firstContainer">
        <div class="row containerRow">
            <div class="col-md-7 align-self-start">
                <h3>

                </h3>
            </div>

            <div class="col-md-5 align-self-end">
                <h2 id="h2TitleStyle">Let's</h2>
                <h2 id="h2TitleStyle">talk about</h2>
                <h1 id="h1TitleStyle">Wellbeing.</h1>
                <p class="containerP">
                    Amid this Coronavirus Lockdown
                </p>
            </div>
        </div>
    </div>

    <div class="dividerContainer">
    </div>

    <!-- 2nd Container -->

    <div class="container-fluid" id="secondContainer">
        <div class="row containerRow">
            <div class="col-md-8">

            </div>

            <div class="col-md-4 align-self-end">

                <h2 id="h2TitleStyle">Be Here</h2>
                <h1 id="h1TitleStyle">
                    Now.
                </h1>
                <p class="containerP">
                    Cut out all superfluous thoughts and kopfkinos. Take responsibility of your present
                    responsibilities.
                    There is no escape; The current situation and its predicament is all we have.
                </p>
            </div>
        </div>
    </div>

    <div class="dividerContainer">
    </div>

    <!-- 3rd Container -->
    <div class="container-fluid" id="thirdContainer">
        <div class="row containerRow">
            <div class="col-md-8">
                <h1 id="h1TitleStyle">Self Restrain</h1>
                <p class="containerP">
                    Restrain yourself from indulging in every impulse and desire during this quarantine; whether that be
                    on
                    social media, casual sex, porn or masturbation.
                    Delay the gratification and develop the self discipline.
                </p>
            </div>
        </div>
    </div>

    <div class="dividerContainer">
    </div>

    <!-- 4th Container -->
    <div class="container-fluid" id="fourthContainer">

        <div class="row containerRow">
            <div class="col-md-8">
                <h1 id="h1TitleStyle">What's the Alternative?</h1>
                <p class="containerP">
                   There is no Escape.
                </p>

                <div class="row">
                    <div class="col-md-10">
                        <div class="card cardBlurred">
                            <div class="card-body">
                                <h3 class="card-title">Want to know more?</h3>
                                <p class="card-text cardP">Why not <a href="signUp.php">Sign up<a> to book
                                            one one one counselling sessions with the Wellbeing Guru, or if
                                            you already have an account <a href="signIn.php">Sign in</a>.
                                </p>
                                <p class="cardP"> Also, you can download a free wellbeing guide to implement these frameworks today.</p>
                                <a target="_blank" href="https://60c02ae6-e672-49db-b184-b0eb999a91f8.filesusr.com/ugd/b96343_c0829f27e39845608528b06a1fa2b7f5.pdf" class="btn btn-primary">Download Wellbeing Guide</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
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