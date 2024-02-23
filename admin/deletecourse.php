<?php   
 include ('components/dbconnection.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `coursedetails` WHERE CourseID = '$id'";  
      $run = mysqli_query($con,$query);  
      if ($run) {  
           header('location:CourseList.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 