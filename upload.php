<?php include 'header.php'; ?>


<?php

require("connect.php");

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  echo '<p>Please sign in to upload your photos</p>';
  echo '<p><a href="login.php">Login</a></p>';
} else {
  echo '<form method="post" action="" enctype="multipart/form-data" class="form"><br>';
  echo '<label for="file-button" class="button">Upload File</label>';
  echo '<input type="file" name="file" id="file-button" class="show-for-sr" /><br>';
  echo '<input type="text" name="caption" required placeholder="Caption your image!" class="form-control"><br>';
  echo '<input type="submit" value="Upload" name="image_upload" class="button"><br>';
  echo '</form>';
}

if(isset($_POST['image_upload'])) {


  if(empty($_POST['caption'])) {
    echo 'you have not entered a caption, try again';
  } elseif (empty($_FILES['file']['name'])) {
    echo 'you have not uploaded a image, try again';
  } else {

    $caption = $_POST['caption'];
    $name = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $sess_user = htmlspecialchars($_SESSION['username']);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

        // Convert to base64
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

        // Insert record
        // $query = "INSERT INTO images (`img_name`, `image`, `username`, `caption`) VALUES ('$name','$image', '$sess_user', '$caption')";
        //
        // mysqli_query($connect,$query) or die(mysqli_error($connect));

        $query = "INSERT INTO images (`img_name`, `image`, `username`, `caption`) VALUES (?, ?, ?, ?)";
        $insertstatement = $connect->prepare($query);
        $insertstatement->bind_param("ssss", $name, $image, $sess_user, $caption);
        $insertstatement->execute();
        $insertstatement->close();
        echo 'Your image was uploaded successfully!';





        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name);

    }

    // close connection
    // mysqli_free_result($result);
    // mysqli_close($connect);

    $connect->close();

   }
}

?>





<?php include 'footer.php';?>
