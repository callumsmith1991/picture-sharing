<?php include 'header.php'; ?>

<div class="parent">




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


if($count > 0) {
 echo '<p>Here is your pictures!</p>';
} elseif ($count > 3) {
  echo '<style>

   .parent {
     height: unset;
   }

  </style>';
} else {
  echo '<div class="center-block text-center modal-content">';
  echo '<p>No pictures submitted yet</p>';
  echo '<p><a href="upload.php" class="btn btn-primary">Upload</a></p>';
  echo '</div>';
}

while ($row = mysqli_fetch_array($userresult)) {
 echo '<div class="col-3">';
 echo '<a data-fancybox="gallery" class="fancyBox"><img src="upload/' .$row['img_name']. '"/></a>';
 echo '<p>' .$row['caption']. '</p>';
 echo '<p><a class="btn btn-danger" href="delete.php?id=' .$row['pic_id']. '">Delete</a></p>';
 echo '<p><a class="btn btn-primary" href="edit.php?id=' .$row['pic_id']. '">Edit Caption</a></p>';
 echo '</div>';
}


// close connection
 mysqli_free_result($userresult);
 mysqli_close($connect);



?>

</div>

<style>

.fancybox-caption {
  display: none;
}

.parent {
  height: inherit;
}


</style>




<?php include 'footer.php';?>
