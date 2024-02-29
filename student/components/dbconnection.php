<?php

$servername = "localhost";
$username = "root";
$serverpassword = "";
$dbname = "classmanagementsystem";
$con = mysqli_connect($servername,$username, $serverpassword, $dbname);
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }
 ?>