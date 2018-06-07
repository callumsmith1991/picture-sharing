<?php include 'header.php'; ?>



<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center">Callum's Photo sharing site</h1>
    <p class="lead text-center">Register as a user and share your photo's!</p>
  </div>
</div>

<div class="row">
  <div class="col">
    <h1 class="lead display-5">
      User uploaded photos:
    </h1>
  </div>
</div>

<div class="parent">

<?php

require 'connect.php';


$displayallimagesquery = "SELECT * FROM images";

$imageresult = mysqli_query($connect,$displayallimagesquery);


while($row = mysqli_fetch_array($imageresult)) {
  echo '<div class="col-3">';
  echo '<img src="upload/' .$row['img_name']. '" />';
  echo '<div class="photo-info">';
  echo '<p>' .$row['username']. '</p>';
  echo '<p>' .$row['caption']. '</p>';
  echo '</div>';
  echo '</div>';
}





 ?>

 </div>

 <script>

   $(document).ready(function() {
     var $span = $(".parent .col-3");
     for (var i = 0; i < $span.length; i += 4) {
      var $div = $("<div/>", {
          class: 'row'
       });
    $span.slice(i, i + 4).wrapAll($div);
      }
   });

 </script>


<?php include 'footer.php';?>
