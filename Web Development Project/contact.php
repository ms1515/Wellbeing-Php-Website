<?php
session_start();
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

    <!-- Optional JavaScript: jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Contact| wellbeing.</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">>
        <a class="navbar-brand" href="#">wellbeing.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">contact</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li> <a class='nav-link' id='navLoginButton' href='signIn.php'>login </a> </li>
            </ul>
        </div>
    </nav>

    <!-- Contact contents -->
    <div class="container-fluid profileRow" id="contactContainer">
    <div class="row ">
            <div class="col-md-1">
                <img class="imgUser" src="img/wellbeingGuru.jpg">
            </div>
            <div class="col-md-11">
                <h1 id="h1TitleStyle"> Contact Me </h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <p class="containerP"> Contact the Wellbeing Guru for any questions or concerns. </p>
            </div>
        </div>

        <!-- Send Message Form -->
        <form action="secure/messages/insertPublicMessage.php" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <input placeholder="Name" type="text" class="form-control" id="name" name="name" minlength="1" maxlength="40" required>
                <div class="invalid-feedback">
                    Please enter a valid name
                </div>
            </div>
            <div class="form-group">
                <input placeholder="Email" type="email" class="form-control" id="email" name="email" minlength="1" maxlength="80" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">
                    Please enter a valid email
                </div>
            </div>
            <div class="form-group">
                <textarea placeholder="Please describe your Query" class="form-control" id="exampleFormControlTextarea1" name="message" minlength="1" maxlength="300" rows="5" required></textarea>
                <div class="invalid-feedback">
                    Please enter a description
                </div>
            </div>
            <div id="submitButton">
                <button type="submit" id="submitButton" name="insertPublicMessageRequest">
                    <h2>Submit</h2>
                </button>
            </div>
        </form>

         <!-- Error Message -->
      <div class="container-fluid">
                <p class="containerP">
                <?php
                    if (isset($_SESSION['insertPublicMessageFeedback'])) {
                        $feedBack = $_SESSION['insertPublicMessageFeedback'];
                        echo $feedBack;
                        unset($_SESSION['insertPublicMessageFeedback']);
                    }
                    ?>
                </p>
            </div>
    </div>


    <!-- footer -->
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