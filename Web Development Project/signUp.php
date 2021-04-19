<?php
session_start();
include("secure/conn.php");

if (isset($_SESSION["username"])) {
    header("Location: index.php");
}
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
    <link rel="stylesheet" href="stylesheet/ui.css">

    <!-- Optional JavaScript: jQuery first, then Popper.js, then Bootstrap JS, then validator -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script> 

    <title>Sign Up| wellbeing.</title>

</head>

<body>

    <!-- Sign Up Navbar-->
    <div class="container-fluid" id="loginContainer">
        <div class="row">
            <div class="col">
                <a class="nav-link" href="index.php">
                    <h2 class="loginHomeItem"> home </h2>
                </a>
            </div>

            <div class="col">
                <a class="nav-link" href="contact.php">
                    <h2 class="loginContactItem">
                        contact
                    </h2>
                </a>
            </div>

        </div>

        <!-- Sign up Title -->
        <div class="row">
            <div class="col">
                <h1 class="loginTitleItem">wellbeing.</h1>
            </div>
        </div>

        <!-- Sign up form -->
        <div class="container-fluid">
            <form class="signUpForm" action="secure/login/signUpUser.php" method="POST" novalidate>
                <div class="form-group">
                    <input placeholder="First Name" type="text" class="form-control" id="firstName" name="firstName" required>
                    <div class="invalid-feedback">
                        Please enter a valid first name
                      </div>
                </div>
                <div class="form-group">
                    <input placeholder="Last Name" type="text" class="form-control" id="lastName" name="lastName"
                        aria-describedby="text" required>
                        <div class="invalid-feedback">
                            Please enter a valid last name
                          </div>
                </div>
                <div class="form-group">
                    <input placeholder="Email" type="email" class="form-control" id="email" name="email"
                        aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                            Please enter a valid email
                          </div>
                </div>
                <div class="form-group">
                    <input placeholder="Password" type="password" class="form-control" id="password" name="password" required equalTo="">
                    <div class="invalid-feedback">
                        Please enter a valid password
                      </div>
                </div>
                <div class="form-group">
                    <input placeholder="Retype Password" type="password" class="form-control" id="reentryPassword" name="reenteredPassword" required>
                    <div class="invalid-feedback" id="invalid-password">
                        Please ensure your re-entered password matches your password
                      </div>
                </div>
                <div id="submitButton">
                            <button type="submit" id="submitButton" name="signUpRequest">
                                <h2>Sign up</h2>
                            </button>
                </div>
            </form>

            <!-- Already have an account button -->
            <div class="container-fluid">
               <p id="loginSignUpText">Already have an account? <a href="signIn.php" id="loginSignUpButton">Sign in</a></p>
               <p id="errorMessage"> 
                   <?php
                   if (isset($_SESSION['signUpError'])) {
                       $errorMessage = $_SESSION['signUpError'];
                       unset($_SESSION['signUpError']);
                       echo "Error Signing up: $errorMessage";
                   }
                   ?>
               </p>
            </div>
        </div>

    </div>

    <!-- footer -->
    <div class="container-fluid footer">
    <p> All rights reserved. </p>
    </div>

    <!-- Validation JavaScript-->
    <script>
        $(document).ready(function() {
            $('.signUpForm').validate({
           rules: {
               password: {
                required: true,
                minlength: 6,
                maxlength: 12
               },
               reenteredPassword: {
                   required: true,
                   minlength: 6,
                   maxlength: 12,
                   equalTo: password 
               }
           }
       });
        });
        </script>

</body>

</html>