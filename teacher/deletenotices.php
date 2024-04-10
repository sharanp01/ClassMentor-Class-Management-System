<?php   
 include ('components/connect.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `announcementdetails` WHERE AnnouncementID = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:managenotice.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 