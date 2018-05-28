<?php include 'header.php'; ?>


<?php

// start session
session_start();

//connect to database
require 'connect.php';

if (isset($_POST['submit'])) {

// save username and password inputted values from form
$loginuser = trim($_POST['username']);
$loginpass = trim($_POST['password']);


if($loginstatement = $connect->prepare("SELECT password FROM users WHERE username = ?")) {

 $loginstatement -> bind_param("s", $loginuser);
 $loginstatement -> execute();
 $loginstatement -> bind_result($result);
 $loginstatement -> fetch();
 $loginstatement -> close();

}

if(password_verify($loginpass, $result)) {
    session_start();
    $_SESSION['username'] = $loginuser; // save session in variable
    header("location: index.php");

} else {
    echo 'invalid credentials';
}


}

// close connection

$connect->close();

?>

<div class="form">
<form action="login.php" method="post">


  <input type="text" name="username" required placeholder="Username" class="form-control"><br><br>

  <input type="password" name="password" required placeholder="Password" class="form-control"><br><br>

  <input type="submit" class="button" name="submit" placeholder="Login here"></a>
  <a class="button" href="register.php">Register here</a>

</form>
</div>




<?php include 'footer.php'; ?>
