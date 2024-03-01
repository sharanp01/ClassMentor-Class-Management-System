<?php
include('components/connect.php');
/* include('components/sidebar.php'); */
$username = "sathya05";
$studentsql = "select * from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];
$col2 = $row1['StudentID'];
$sql = "Select * from assignmentmarks where StudentID= '$col2'";
$studentresult2 = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($studentresult2);
$col3 = $row2['Marks'];
echo $col3;
?>