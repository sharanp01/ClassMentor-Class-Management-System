<?php  
session_start();
if (!isset($_SESSION['username'])) {
     header("Location: ../index.php");
     exit();
 } 
 include ('components/connect.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `resourcedetails` WHERE ResourceID = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:manageresources.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 