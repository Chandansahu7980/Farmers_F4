<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "project4dbs";
// $database = "test";

//Established connection to the database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("<h2>Conntecting to database failed !</h2>".$conn->error);
}
else{
    echo "<script>console.log('database connection success');</script>";
}