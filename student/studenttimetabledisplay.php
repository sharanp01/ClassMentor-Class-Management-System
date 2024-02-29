<?php
include("components/connect.php");
 include('components/sidebar.php'); 
$username = "sathya05";
$studentsql = "select CourseID from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];
$currentDate = date('Y-m-d');
$sql = "SELECT teacherdetails.Firstname, subjectdetails.Subjectname, timetabledetails.Date, timetabledetails.Starttime, timetabledetails.Endtime 
FROM timetabledetails
INNER JOIN teacherdetails ON teacherdetails.TeacherID = timetabledetails.TeacherID
INNER JOIN subjectdetails ON subjectdetails.SubjectID = timetabledetails.SubjectID
WHERE timetabledetails.CourseID='$col1' AND timetabledetails.Date >='$currentDate'
ORDER BY timetabledetails.Date ASC"; /* TeacherID='".$_SESSION['user']."' */
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <title>Document</title>
</head>

<body>
    <section class="home-section">

        <div class="home-content">
            <div class="left-content">
                ClassMentor
            </div>
            <div class="right-content">
                <label for="" class="dropdowntext">Welcome</label>
                <div class="dropdown">

                    <button class="dropbtn">Dropdown</button>
                    <div class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-control">
            <h1 class="heading-text">Timetable</h1>
            <?php
            if (mysqli_num_rows($result) > 0) {
            ?>

                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Teacher Name</th>
                        <th>Subject Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>

                <?php
                $i = 1;
                while ($result3 = mysqli_fetch_assoc($result)) {

                    echo "  
         <tr class='data'>  
              <td>" . $i . "</td>  
              <td>" . $result3['Firstname'] . "</td>
              <td>" . $result3['Subjectname'] . "</td>
              <td>" . date('d-m-Y', strtotime($result3['Date'])) ."</td>
              <td>" . date('H:i', strtotime($result3['Starttime'])) ."</td>
              <td>". date('H:i', strtotime($result3['Endtime'])) . "</td>
              
         </tr>  
    ";
                    $i++;
                }
            } else {
                echo "<div class='successmsg'><label class='successtext'>Data not found</label><br>
            <label class='successtext'>No lectures Schedules To Schedule New Lectures <br><div class='btndiv'><a href='timetabledetails.php' class='button deletetext'>Click Here!</a></div></label></div>";
            }

                ?>
        </div>
    </section>
</body>

</html>