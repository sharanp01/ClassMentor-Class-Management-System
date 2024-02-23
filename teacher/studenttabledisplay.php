<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $username= "Divya01";
    $sql = "select * from teacherdetails where Username= '$username' "; 
    $result = mysqli_query($conn,$sql);
    $answer = mysqli_fetch_assoc($result);
    $answer2 = $answer['TeacherID'];
    echo $answer2."<br>";
    $sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
    $result2 = mysqli_query($conn,$sql2);
    $subjectanswer = mysqli_fetch_assoc($result2);
    $subjectanswer2 = $subjectanswer['SubjectID'];
    echo $subjectanswer2."<br>";
    $sql3 = "select CourseID from subjectdetails where SubjectID = '$subjectanswer2'";
    $result3 = mysqli_query($conn,$sql3);
    $courseanswer = mysqli_fetch_assoc($result3);
    $courseanswer2 = $courseanswer['CourseID'];
    echo $courseanswer2;
    $sql4 = "select Firstname, Lastname, Email, Phone from studentdetails where CourseID = '$courseanswer2'";
    $result4 = mysqli_query($conn,$sql4);
    if ($result4) {
        if (mysqli_num_rows($result4) > 0) { ?>
            <div class="table-control">
                <table border="1" cellspacing="6" cellpadding="6">
                    <tr class="heading">
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        
                    </tr>

        <?php
            $i = 1;
            while ($result5 = mysqli_fetch_assoc($result4)) {
                echo "  
         <tr class='data'>  
             
              <td>" . $result5['Firstname'] . "</td>  
              <td>" . $result5['Lastname'] . "</td>  
              <td>" . $result5['Email'] . "</td>  
              <td>" . $result5['Phone'] . "</td>  
 
         </tr>  
             
    ";
    $i++;
            }
        } else {
            echo "<div class='btndiv'>Data not found</div>";
        }
    }

    
    ?>
</body>
</html>