<?php include 'header.php'; ?>





<?php

require 'connect.php';

$id = $_GET['id'];

$selectquery = "SELECT * FROM images WHERE pic_id = '".$id."'";

$result = mysqli_query($connect,$selectquery);

while ($row = mysqli_fetch_array($result)) {
  $caption = $row['caption'];
}

if(isset($_POST['update'])) {

$editedcaption = $_POST['editedcaption'];

$updatequery = "UPDATE images SET caption = '.$editedcaption.' WHERE pic_id = '" .$id."'";

$updateresult = mysqli_query($connect,$updatequery);

if($updateresult) {
  echo 'edited caption successfully';
} else {
  die("ERROR: data not inserted. " . mysqli_error());
}

}

?>


<div class="center-block">

 <form action="" method="post">
  <input type="text" name="editedcaption" value="<?php echo $caption; ?>" class="form-control" />
  <input type="submit" value="Update caption" name="update" class="btn btn-primary">
 </form>

</div>




<style>

body {
  position: absolute;
}

</style>








<?php include 'footer.php'; ?>
