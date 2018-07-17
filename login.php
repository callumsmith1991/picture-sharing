


<?php

// start session
// session_start();

include 'header.php';

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
  echo '<script>';
  echo 'alert("invalid credentials")';
  echo '</script>';
}


}

// close connection

$connect->close();

?>

<div class="form center-block">
<h2>Login</h2>
<form action="login.php" method="post">
  <input type="text" name="username" required placeholder="Username" class="form-control"><br><br>
  <input type="password" name="password" required placeholder="Password" class="form-control"><br><br>
  <p class="text-center">
    <input type="submit" class="btn btn-primary" name="submit" placeholder="Login here" value="Login" />
    <a class="btn btn-primary" href="register.php">Register here</a>
  </p>
</form>
</div>

<style>

body {
  position: absolute;
}

</style>



<?php include 'footer.php'; ?>
