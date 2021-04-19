<?php
session_start();
include("../conn.php");

if (!isset($_SESSION["username"])) {
    header("Location: ../../index.php");
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
    <link rel="stylesheet" href="../../stylesheet/ui.css">

    <!-- Optional JavaScript: jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <!-- DatePicker -->
     <script>
        $(function () {
            $('#datepick').datepicker();
        });
    </script>

    <title>Add Session| wellbeing.</title>

</head>

<body>

    <div class="container-fluid" id="loginContainer">
        <!-- Nav Bar -->
        <div class="row">
            <div class="col">
                <a class="nav-link" href="../../index.php">
                    <h2 class="loginHomeItem"> home </h2>
                </a>
            </div>

            <div class="col">
                <a class="nav-link" href="../profile.php">
                    <h2 class="loginContactItem">
                        profile
                    </h2>
                </a>
            </div>

        </div>

        <!-- Book a session Title -->
        <div class="row">
            <div class="col">
                <h1 class="loginTitleItem">Book a Session</h1>
            </div>
        </div>

        <!-- Book a session Form -->
        <div class="container-fluid">
            <form class="needs-validation" action="insertSession.php" method="POST" novalidate>
                <div class="form-group">
                    <input placeholder="Select Date for Session " class="form-control" type="text" id="datepick" name="dueDate" required />
                    <div class="invalid-feedback">
                        Please enter a date for the session
                      </div>
                </div>
                <div class="form-group">
                    <label for="session-type">Select Session Type</label>
                    <select class="form-control" id="" name='sessionType' required>
                        <option value="General Counselling">General Counselling</option>
                        <option value="Pandemic Advice">Pandemic Advice</option>
                        <option value="Health and Wellbeing">Health and Wellbeing</option>
                        <option value="Depression Counselling">Depression Counselling</option>
                        <option value="Career Advice">Career Advice</option>
                    </select>
                    <div class="invalid-feedback">
                        Please choose a category for the session
                      </div>
                </div>
                <div id="submitButton">
                    <button type="submit" id="submitButton" name="insertSessionRequest">
                        <h2>Send Request</h2>
                    </button>
                </div>
            </form>

            <!-- Error Message -->
            <div class="container-fluid">
                <p id="errorMessage">
                    <?php
                    if (isset($_SESSION['insertSessionError'])) {
                        $bookingError = $_SESSION['insertSessionError'];
                        echo "Error Booking a session: $bookingError";
                        unset($_SESSION['insertSessionError']);
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

    <!-- Validation Script -->
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
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