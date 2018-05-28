<div class="row">

<?php include 'header.php'; ?>

<?php

require 'connect.php';

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
}

$loggedinuser = htmlspecialchars($_SESSION['username']);

$userquery = "SELECT * FROM images WHERE username = '".$loggedinuser."'";

//execute sql query
$userresult = mysqli_query($connect,$userquery);

// count number of rows with this username
$count = mysqli_num_rows($userresult);


if($count == 1) {
 echo '<div class="row">';
 echo '<div class="small-12 large-4 columns">';
 echo '<p>we have found one picture</p>';
 echo '</div>';
 echo '</div>';
} elseif ($count > 1) {
  echo '<div class="row">';
  echo '<div class="small-12 large-4 columns">';
  echo 'we have found a few pictures you submitted';
  echo '</div>';
  echo '</div>';
} else {
  echo '<div class="row">';
  echo '<div class="small-12 large-4 columns">';
  echo 'no pictures submitted yet';
  echo '</div>';
  echo '</div>';
}

while ($row = mysqli_fetch_array($userresult)) {
 echo '<div class="small-12 large-4 columns">';
 echo '<p><img src="upload/' .$row['img_name']. '"/></p>';
 echo '<p>' .$row['caption']. '</p>';
 echo '<p><a class="alert button" href="delete.php?id=' .$row['pic_id']. '">Delete</a></p>';
 echo '<p><a class="btn btn-danger" href="edit.php?id=' .$row['pic_id']. '">Edit Caption</a></p>';
 echo '</div>';
}

// close connection
 mysqli_free_result($userresult);
 mysqli_close($connect);



?>


</div>




<?php include 'footer.php';?>
