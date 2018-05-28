<?php include 'header.php'; ?>



<?php

// Simple PHP script to insert data into database

if(isset($_POST['insert'])) {

// connect to database
require 'connect.php';

// server side validation aganist empty input
if (empty($_POST['username'])) {
  echo 'Username is missing, Please input username';
} elseif (empty($_POST['email'])) {
  echo 'Email is missing, Please input email';
} elseif (empty($_POST['password'])) {
  echo 'Password is missing, Please input password';
} else {

  // define variables to input form data into database
  $name = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  // encrypt password using password hash and salting
  $password_encrypted = password_hash($pass, PASSWORD_BCRYPT);


  // search database if username already exists
  // $searchforuserexistsquery = "SELECT username FROM users WHERE username = '" .$name. "'";
  // $ifuserexists = mysqli_query($connect, $searchforuserexistsquery);
  // $userfound = mysqli_fetch_assoc($ifuserexists);

    $searchforuserexistsquery = "SELECT count(1) FROM users WHERE username = ?";
    $selectstatement = $connect->prepare($searchforuserexistsquery);
    $selectstatement->bind_param("s", $name);
    $selectstatement->execute();
    $selectstatement->bind_result($userfound);
    $selectstatement->fetch();
    $selectstatement->close();


  if($userfound) {
   echo 'username already taken';
  } else {
   // SQL query to insert into database
   // $query = "INSERT INTO users (`username`, `email`, `password`) VALUES ('$name', '$email', '$password_encrypted')";
   // $result = mysqli_query($connect,$query);
   // echo 'user successfully registered';
   $query = "INSERT INTO users (`username`, `email`, `password`) VALUES (?, ?, ?)";
   $insertstatement = $connect->prepare($query);
   $insertstatement->bind_param("sss", $name, $email, $password_encrypted);
   $insertstatement->execute();
   $insertstatement->close();
   echo 'user successfully registered';
  }
}

// close connection
$connect->close();

}



?>


<div class="form">
        <form action="" method="post" id="registerform">


            <input type="text" name="username" placeholder="Username" class="form-control" /><br><br>
            <input type="email" name="email" placeholder="Email" class="form-control" /><br><br>
            <input type="password" name="password" placeholder="Password" class="form-control" /><br><br>
            <input type="submit" name="insert" value="Register" class="button" />

        </form>
  </div>

<script src="js/validateregistration.js"></script>

<?php include 'footer.php'; ?>
