<?php

$servername = "localhost";
$username = "root";
$serverpassword = "";
$dbname = "classmanagementsystem";
$conn = mysqli_connect($servername,$username, $serverpassword, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
 ?>