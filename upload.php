<?php include 'header.php'; ?>


<?php

require("connect.php");

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  echo '<div class="center-block">';
  echo '<p class="text-center">Please sign in to upload your photos</p>';
  echo '<p class="text-center"><a class="btn btn-primary" href="login.php">Login</a></p>';
  echo '</div>';
} else {
  echo '<div class="center-block">';
  echo '<form method="post" action="" enctype="multipart/form-data" class="form"><br>';
  echo '<label for="file-button" class="button">Upload File</label>';
  echo '<input type="file" name="file" id="file-button" class="form-control-file" /><br>';
  echo '<input type="text" name="caption" required placeholder="Caption your image!" class="form-control"><br>';
  echo '<input type="submit" value="Upload" name="image_upload" class="btn btn-primary"><br>';
  echo '</form>';
  echo '</div>';
}

if(isset($_POST['image_upload'])) {


  if(empty($_POST['caption'])) {
    echo '<script>';
    echo 'alert("you have not entered a caption, try again")';
    echo '</script>';
  } elseif (empty($_FILES['file']['name'])) {
    echo '<script>';
    echo 'alert("you have not uploaded a image, try again")';
    echo '</script>';
  } else {

    $caption = $_POST['caption'];
    $name = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $sess_user = htmlspecialchars($_SESSION['username']);

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $extensions_arr = array("jpg","jpeg","png","gif");

    if( in_array($imageFileType,$extensions_arr) ){


        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        $query = "INSERT INTO images (`img_name`, `image`, `username`, `caption`) VALUES (?, ?, ?, ?)";
        $insertstatement = $connect->prepare($query);
        $insertstatement->bind_param("ssss", $name, $image, $sess_user, $caption);
        $insertstatement->execute();
        $insertstatement->close();
        echo '<script>';
        echo 'alert("Your image was uploaded successfully")';
        echo '</script>';
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name);
    } else {
      echo '<script>';
      echo 'alert("This is not a valid image, try again")';
      echo '</script>';
    }


    $connect->close();

   }
}

?>

<style>

body {
  position: absolute;
}

</style>




<?php include 'footer.php';?>
