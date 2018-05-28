<?php

//including the database connection file
include("connect.php");

//getting id of the data from url
$id = $_GET['id'];


$selectquery = "SELECT * FROM images WHERE pic_id = '".$id."'";

$result = mysqli_query($connect,$selectquery);

$row = mysqli_fetch_array($result);

// deleting file from uploads folder
unlink("upload/$row[img_name]");

$deletequery = "DELETE FROM images WHERE pic_id = '".$id."'";

//deleting the row from table
mysqli_query($connect,$deletequery);

// close connection
 mysqli_free_result($result);
 mysqli_close($connect);
 
//redirecting to the display page (index.php in our case)
header("Location:profile.php");

?>
