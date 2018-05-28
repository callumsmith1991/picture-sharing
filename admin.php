<?php include 'header.php'; ?>

<?php

if($userprofile === "cmsmith1") {
  echo '<h1>Admin Dash</h1>';
} else {
  header("location: index.php");
}

?>

<h2>Images Currently in database</h2>
<table class="unstriped stack">
<thead>
<th>Image</th>
<th>Username</th>
<th>Caption</th>
<th></th>
</thead>
<tbody>


<?php

require 'connect.php';

$displayallimagesquery = "SELECT * FROM images";

$imageresult = mysqli_query($connect,$displayallimagesquery);

while($row = mysqli_fetch_array($imageresult)) {
  echo '<tr>';
  echo '<td><img src="upload/' .$row['img_name']. '" width="200" height="200" /></td>';
  echo '<td>' .$row['username']. '</td>';
  echo '<td>' .$row['caption']. '</td>';
  echo '<td><a class="alert button" href="delete.php?id=' .$row['pic_id']. '">Delete</a></td>';
  echo '</tr>';
}


?>

</tbody>
</table>

<?php include 'footer.php'; ?>
