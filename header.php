
<!DOCTYPE html>

<html>

    <head>

        <title> Callum Custom PHP MYSQL test </title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <link href="bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

<div class="container-fluid">



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="upload.php">Upload Photo</a>
        </li>
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <?php
        // Initialize the session
        session_start();

        // If session variable is not set it will redirect to login page
        if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
          echo '<li><a class="nav-link" href="login.php">Login</a></li>';
          $userprofile = "";
        } else {
          $userprofile = htmlspecialchars($_SESSION['username']);
          echo  '<li><a class="nav-link" href="profile.php">' .$userprofile. '</a></li> ';
          echo '<li><a class="nav-link" href="logout.php">logout</a></li>';
        }

        if($userprofile === "cmsmith1") {
          echo '<li><a class="nav-link" href="admin.php"> Admin Dashboard</a></li>';
        }

        ?>
      </ul>

    </div>
  </nav>

  <div class="page-content">
    <div class="wrap">
