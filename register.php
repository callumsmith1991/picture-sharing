<?php include 'header.php'; ?>



<?php

// Simple PHP script to insert data into database

if(isset($_POST['insert'])) {

// connect to database
require 'connect.php';

// server side validation aganist empty input
if (empty($_POST['username'])) {
  echo '<script>';
  echo 'alert("Username missing, please give username")';
  echo '</script>';
} elseif (empty($_POST['email'])) {
  echo '<script>';
  echo 'alert("Email missing, please give email")';
  echo '</script>';
} elseif (empty($_POST['password'])) {
  echo '<script>';
  echo 'alert("Password missing, please give a password")';
  echo '</script>';
} else {

  // define variables to input form data into database
  $name = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  // encrypt password using password hash and salting
  $password_encrypted = password_hash($pass, PASSWORD_BCRYPT);


    $searchforuserexistsquery = "SELECT count(1) FROM users WHERE username = ?";
    $selectstatement = $connect->prepare($searchforuserexistsquery);
    $selectstatement->bind_param("s", $name);
    $selectstatement->execute();
    $selectstatement->bind_result($userfound);
    $selectstatement->fetch();
    $selectstatement->close();


  if($userfound) {
    echo '<script>';
    echo 'alert("Username already exists, Please try another one")';
    echo '</script>';
  } else {
   $query = "INSERT INTO users (`username`, `email`, `password`) VALUES (?, ?, ?)";
   $insertstatement = $connect->prepare($query);
   $insertstatement->bind_param("sss", $name, $email, $password_encrypted);
   $insertstatement->execute();
   $insertstatement->close();
   echo '<script>';
   echo 'alert("user successfully registered")';
   echo '</script>';
  }
}

// close connection
$connect->close();

}



?>


<div class="center-block">
  <h2>Registration form</h2>
        <form action="" method="post" id="registerform">
            <input type="text" name="username" placeholder="Username" class="form-control" /><br><br>
            <input type="email" name="email" placeholder="Email" class="form-control" /><br><br>
            <input type="password" name="password" placeholder="Password" class="form-control" /><br><br>
            <p class="text-center">
              <input type="submit" name="insert" value="Register" class="btn btn-primary" />
            </p>
        </form>
  </div>

  <style>

  body {
    position: absolute;
  }

  </style>

<script src="js/validateregistration.js"></script>

<?php include 'footer.php'; ?>
