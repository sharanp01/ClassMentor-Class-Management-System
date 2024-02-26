<?php
include("components/connect.php");
include("components/sidebar.php");
$username = "Divya01";
$sql = "select * from teacherdetails where Username= '$username' ";
$result = mysqli_query($conn, $sql);
$answer = mysqli_fetch_assoc($result);
$answer2 = $answer['TeacherID'];
$sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
$result2 = mysqli_query($conn, $sql2);
$subjectanswer = mysqli_fetch_assoc($result2);
$subjectname = $subjectanswer['Subjectname'];
$subjectanswer2 = $subjectanswer['SubjectID'];
$sql3 = "select CourseID from subjectdetails where SubjectID = '$subjectanswer2'";
$result3 = mysqli_query($conn, $sql3);
$courseanswer = mysqli_fetch_assoc($result3);
$courseanswer2 = $courseanswer['CourseID'];
$sql4 = "select Firstname, Lastname, Email, Phone from studentdetails where CourseID = '$courseanswer2'";
$sql5 = "SELECT COUNT(*) AS total_rows FROM studentdetails where CourseID = '$courseanswer2'";
$result4 = mysqli_query($conn, $sql4);
$result5 = mysqli_query($conn, $sql5);
if ($result5) {
    $row = $result5->fetch_assoc();
    $total_rows2 = $row['total_rows'];
}
$currentDate = date('Y-m-d');
$sql = "SELECT * FROM timetabledetails WHERE Date >= '$currentDate' AND TeacherID='$answer2' ORDER BY Date ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currdate = date('d-m-Y', strtotime($row['Date']));
    $start = date('H:i', strtotime($row['Starttime']));
    $end = date('H:i', strtotime($row['Endtime']));
} else {
    $currdate = "No lectures scheduled yet";
    $start = "No time scheduled";
    $end = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <link rel="stylesheet" href="styles/dashboardstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
        <div class="headertext">
            <img src="images/dashboard.png" alt="" class="dashimage">
            <label for="" class="dashtext">Dashboard</label>
        </div>
        <div class="stat">
            <div class="subname">
                <label for="" class="count">Name of your Subject:</label><br>
                <label for="" class="statcount count"><?php echo $subjectname; ?></label>
            </div>
            <div class="studstat">
                <label for="" class="count">Number of Students:</label><br>
                <label for="" class="statcount count"><?php echo $total_rows2; ?></label>
            </div>
            <div class="timestat">
                <label for="" class="count">Next lec scheduled on: <?php echo $currdate;?> </label><br>
                <label for="" class="statcount count">Start Time: <?php echo $start;?></label><br>
                <label for="" class="statcount count">Endtime Time: <?php echo $end;?></label>
            </div>
        </div>
      
        <?php
        if ($result4) {
            if (mysqli_num_rows($result4) > 0) { ?>
                <div class="table-control">

                    <label for="" class="dashtext">Students under your subject</label>

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
    </section>
</body>

</html>
