<?php 
include('components/sidebar.php');
include('components/dbconnection.php');
$query = "select * from teacherdetails";  
$run = mysqli_query($con,$query);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css"/>
    <title>Teacher list</title>
</head>
<body>
<div class="mainpage">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="pagetitle">Teacher Data</h3>
        </div>
        <div class="row">
          <div class="card">
            <div class="cardbody">
            <form action="" method="POST" class="formsample">
              <div class="form-group">
                        <label class="form-text text-size">Enter the Username of the Teacher to access their Details</label>
                        <input type="text" name="searchname" id="errormsg" value="" class="form-control input-text">
            </div>
            <div class="btndiv"><button class="btn" name="submit" value="submit">Search Data</button>
            <button class="btn" name="submit2" value="submit2">Get full list</button></div>
            </form>
            <?php 
                if(isset($_POST['submit'])) {
                    $search =  mysqli_real_escape_string($con, ($_POST['searchname']));
                    $sql2 ="Select * from teacherdetails where Firstname='$search'";
                    $result2 = mysqli_query($con, $sql2);
                    if($result2){
                        if(mysqli_num_rows($result2)>0)
                        {?>
                         <div class="table-control">
            <table border="1" cellspacing="6" cellpadding="6">  
      <tr class="heading">  
           <th>Teacher ID</th>  
           <th>Firstname</th>  
           <th>Lastname</th>  
           <th>Email</th>  
           <th>Phone</th>  
           <th>Subjects Taken</th>  
           <th>Education</th>  
           <th>Username</th>
           <th>Password</th>  
                        </tr>

                        <?php
                        $i=1;
                          while ($result3 = mysqli_fetch_assoc($result2)) {  
                            echo "  
                                 <tr class='data'>   
                                      <td>".$result3['TeacherID']."</td>  
                                      <td>".$result3['Firstname']."</td>  
                                      <td>".$result3['Lastname']."</td>  
                                      <td>".$result3['Email']."</td>  
                                      <td>".$result3['Phone']."</td>  
                                      <td>".$result3['Subjectstaken']."</td>  
                                      <td>".$result3['Education']."</td>  
                                      <td>".$result3['Username']."</td>  
                                      <td>".$result3['Password']."</td>  
                                      <td><a href='deleteteacher.php?id=".$result3['TeacherID']."' id='btn'>Delete</a></td>  
                                 </tr>  
                            "; 
                            $i++; 
                       }   
                        }
                        else{
                            echo "Data not found";
                        }
                        
                    } }?>
                
            <?php 
                if(isset($_POST['submit2'])) {?>
            <div class="table-control">
            <table border="1" cellspacing="6" cellpadding="6">  
      <tr class="heading">  
           <th>Teacher ID</th>  
           <th>Firstname</th>  
           <th>Lastname</th>  
           <th>Email</th>  
           <th>Phone</th>  
           <th>Subjects Taken</th>  
           <th>Education</th>  
           <th>Username</th>
           <th>Password</th>  
      </tr>    <?php   
      $i=1;  
           if ($num = mysqli_num_rows($run)>0) {  
                while ($result = mysqli_fetch_assoc($run)) {  
                     echo "  
                          <tr class='data'>  
                               <td>".$result['TeacherID']."</td>  
                               <td>".$result['Firstname']."</td>  
                               <td>".$result['Lastname']."</td>  
                               <td>".$result['Email']."</td>  
                               <td>".$result['Phone']."</td>  
                               <td>".$result['Subjectstaken']."</td>  
                               <td>".$result['Education']."</td>  
                               <td>".$result['Username']."</td>  
                               <td>".$result['Password']."</td>  
                               <td><a href='delete.php?id=".$result['TeacherID']."' id='btn'>Delete</a></td>  
                          </tr>  
                     ";  
                     $i++;
                }  
           }  
      ?> 
            </table>
            </div>
<?php }?>

            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>