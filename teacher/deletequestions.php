<?php   
 include ('components/connect.php');  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `quizdetails` WHERE QuestionID = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:displaytest.php');  
           echo "datadeleted";
      }else{  
           echo "Error: ".mysqli_error($con);  
      } 
 }  
 ?> 