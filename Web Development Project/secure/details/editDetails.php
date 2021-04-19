<?php
session_start();
include('../conn.php');

if (!isset($_SESSION["userId"])) {
    header("Location: ../../index.php");
    return;
}

$currentUserId = $_SESSION['userId'];
$fetchCurrentUserDetailsQuery = "SELECT * FROM userDetails WHERE userId=$currentUserId";
$fetchCurrentUserDetailsResult = $conn->query($fetchCurrentUserDetailsQuery);

if (!$fetchCurrentUserDetailsResult) {
    echo $conn->error;
} else {
    $currentUserDetails = $fetchCurrentUserDetailsResult->fetch_assoc();
    $address = $currentUserDetails['streetAddress'];
    $postCode = $currentUserDetails['postCode'];
    $city = $currentUserDetails['city'];
    $country = $currentUserDetails['country'];
    $phone = $currentUserDetails['phone'];
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

    <title>Edit Details| wellbeing.</title>

</head>

<body>

    <!-- Nav Bar -->
    <div class="container-fluid" id="loginContainer">
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

        <!-- Sign In Title -->
        <div class="row">
            <div class="col">
                <h1 class="loginTitleItem">Edit Details</h1>
            </div>
        </div>

         <!-- Sign In Form -->
        <div class="container-fluid">
            <form class="needs-validation" action="updateDetails.php" method="POST" novalidate>
                <div class="form-group">
                    <input placeholder="Street Address" type="text" class="form-control" id="address" name="address" value=<?php echo $address; ?>
                         required>
                        <div class="invalid-feedback">
                            Please enter a valid address
                          </div>
                </div>
                <div class="form-group">
                    <input placeholder="Post Code" type="text" class="form-control" id="postCode" name="postCode" value=<?php echo $postCode; ?>
                         required>
                        <div class="invalid-feedback">
                            Please enter a valid Post Code
                          </div>
                </div>
                <div class="form-group">
                    <input placeholder="City" type="text" class="form-control" id="city" name="city" default=<?php echo $city; ?> required>
                    <div class="invalid-feedback">
                        Please enter a City Name
                      </div>
                </div>
                <div class="form-group">
                    <input placeholder="Country" type="text" class="form-control" id="country" name="country" value=<?php echo $country; ?> required>
                    <div class="invalid-feedback">
                        Please enter a Country Name
                      </div>
                </div>
                <div class="form-group">
                    <input placeholder="Phone Number" type="number" class="form-control" id="phone" name="phone" value=<?php echo $phone; ?> required>
                    <div class="invalid-feedback">
                        Please enter a Phone Number
                      </div>
                </div>
                <div id="submitButton">
                            <button type="submit" id="submitButton" name="updateDetailsRequest">
                                <h2>Update Details</h2>
                            </button>
                </div>
            </form>

            <!-- Don't have an account button -->
            <div class="container-fluid">
               <p id="errorMessage"> 
                   <?php
                   if (isset($_SESSION['updateDetailsError'])) {
                       $errorMessage = $_SESSION['updateDetailsError'];
                       unset($_SESSION['updateDetailsError']);
                       echo "Error updating Details: $errorMessage";
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