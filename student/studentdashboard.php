<?php
session_start();
include('components/sidebar.php');
include('components/connect.php');
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
$studentsql = "select CourseID from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];
$subjectsql = "SELECT subjectdetails.Subjectname, teacherdetails.Firstname FROM subjectdetails
               INNER JOIN teacherdetails ON teacherdetails.TeacherID = subjectdetails.TeacherID
               WHERE CourseID = '$col1'";
$subjectresult = mysqli_query($conn, $subjectsql);
$currentDate = date('Y-m-d');
$nextDate = date('Y-m-d', strtotime($currentDate . ' + 1 day')); // Get the date for the next day after the current date
$schedulesql = "SELECT teacherdetails.Firstname, subjectdetails.Subjectname, timetabledetails.Date, timetabledetails.Starttime, timetabledetails.Endtime 
FROM timetabledetails
INNER JOIN teacherdetails ON teacherdetails.TeacherID = timetabledetails.TeacherID
INNER JOIN subjectdetails ON subjectdetails.SubjectID = timetabledetails.SubjectID
WHERE timetabledetails.CourseID='$col1' AND timetabledetails.Date > '$currentDate'
ORDER BY timetabledetails.Date ASC, timetabledetails.Starttime ASC";

$scheduleresult = mysqli_query($conn, $schedulesql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <section class="home-section">
        <div class="home-content">
            <div class="left-content">
                ClassMentor
            </div>
            <div class="right-content">
                <label for="" class="dropdowntext" style="margin-right: 30px;">Welcome <?php echo $username; ?></label>
                <div class="dropdown">
                    <div class="dropdown">
                        <a href="logout.php"><button class="Btn">
                                <div class="sign"><svg viewBox="0 0 512 512">
                                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                    </svg></div>
                                <div class="text">Logout</div>
                            </button>
                        </a>
                    </div>s
                </div>
            </div>
        </div>
        </div>
        <div class="headertext">

            <img src="images/dashboard.png" alt="" class="dashimage">
            <label for="" class="dashtext">Dashboard</label>
        </div>
        <div class="table-control">
            <h1>Subjects Under this Course:</h1>
            <?php
            if (mysqli_num_rows($subjectresult) > 0) {
            ?>

                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Subject Name</th>
                        <th>Teacher Assigned</th>
                    </tr>

                <?php
                $i = 1;
                while ($result3 = mysqli_fetch_assoc($subjectresult)) {

                    echo "  
         <tr class='data'>  
              <td>" . $i . "</td>  
              <td>" . $result3['Subjectname'] . "</td>
              <td>" . ucwords($result3['Firstname']) . "</td>
              
         </tr>  
    ";
                    $i++;
                }
            } else {
                echo "<div class='btndiv centerdiv'><label class='successtext'>Subjects not found</label><br></div>";
            }
              }      ?>
        </div>
    </section>
</body>

</html>