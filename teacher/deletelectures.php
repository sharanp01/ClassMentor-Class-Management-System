<?php
include('components/connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM `timetabledetails` WHERE TimetableID = '$id'";
    $run = mysqli_query($conn, $query);
    if ($run) {
        echo "<alert>Date Deleted</alert>";
        header('location:displaytimetable.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
