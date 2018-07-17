<?php

// step one: define variables for database credentials (hostname, username, password and database name)

 $hostname = "localhost";
 $username = "root";
 $password = "root";
 $databaseName = "picture_app";

// step two: define variable to connect to Database

// test database connection

 $connect = mysqli_connect($hostname, $username, $password, $databaseName);

 if($connect === false){
     die("ERROR: Could not connect. " . mysqli_connect_error());
 }

?>
