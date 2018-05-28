
<!DOCTYPE html>

<html>

    <head>

        <title> Callum Custom PHP MYSQL test </title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.css">
        <script src="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.js"></script>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

<div class="container">

<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li>Site Title</li>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="upload.php">Upload a photo!</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <?php
      // Initialize the session
      session_start();

      $userprofile = htmlspecialchars($_SESSION['username']);

      // If session variable is not set it will redirect to login page
      if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        echo '<li><a href="login.php">Login</a></li>';
      } else {
        echo  '<li><a href="profile.php">' .$userprofile. '</a></li> ';
        echo '<li><a href="logout.php">logout</a></li>';
      }

      if($userprofile === "cmsmith1") {
        echo '<li><a href="admin.php"> Admin Dashboard</a></li>';
      }

      ?>
    </ul>
  </div>
</div>
