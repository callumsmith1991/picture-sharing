<?php include 'header.php'; ?>



<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center">Callum's Photo sharing site</h1>
    <p class="lead text-center">Register as a user and share your photo's!</p>
  </div>
</div>



<div class="parent">

  <div class="row">
    <div class="col">
      <h1 class="lead display-5">
        User uploaded photos:
      </h1>
      <p>
        Click on the photo for more info!
      </p>
    </div>
  </div>

<?php

require 'connect.php';


$displayallimagesquery = "SELECT * FROM images";

$imageresult = mysqli_query($connect,$displayallimagesquery);


while($row = mysqli_fetch_array($imageresult)) {
  echo '<div class="col-3">';
  echo '<a data-fancybox="gallery" class="fancyBox"><img src="upload/' .$row['img_name']. '" /></a>';
  echo '<div class="photo-info">';
  echo '<p class="username">' .$row['username']. '</p>';
  echo '<p class="photo-caption">' .$row['caption']. '</p>';
  echo '</div>';
  echo '</div>';
}


 ?>

 </div>



<?php include 'footer.php';?>
