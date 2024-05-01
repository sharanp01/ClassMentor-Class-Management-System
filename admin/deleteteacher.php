<?php   
session_start();
if (!isset($_SESSION['username'])) {
     header("Location: index.php");
     exit();
 }
 include ('components/dbconnection.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `teacherdetails` WHERE TeacherID = '$id'";  
      $run = mysqli_query($con,$query);  
      if ($run) {  
           header('location:TeacherList.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 