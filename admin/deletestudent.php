<?php   
session_start();
if (!isset($_SESSION['username'])) {
     header("Location: index.php");
     exit();
 }
 include ('components/dbconnection.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `studentdetails` WHERE StudentID = '$id'";  
      $run = mysqli_query($con,$query);  
      if ($run) {  
           header('location:StudentList.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 