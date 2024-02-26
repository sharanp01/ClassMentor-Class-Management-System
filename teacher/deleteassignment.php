<?php   
 include ('components/connect.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `assignmentdetails` WHERE AssignmentID = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:assignmentlist.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 