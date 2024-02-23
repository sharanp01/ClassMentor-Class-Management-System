<?php

include('components/connect.php');
include('components/sidebar.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
        <form action="" method="POST">
            <?php
            $username = "Divya01";
            $sql = "select * from teacherdetails where Username= '$username' ";
            $result = mysqli_query($conn, $sql);
            $answer = mysqli_fetch_assoc($result);
            $answer2 = $answer['TeacherID'];
            $sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
            $result2 = mysqli_query($conn, $sql2);
            $subjectanswer = mysqli_fetch_assoc($result2);
            $subjectanswer2 = $subjectanswer['SubjectID'];
            $sql3 = "select CourseID from subjectdetails where SubjectID = '$subjectanswer2'";
            $result3 = mysqli_query($conn, $sql3);
            $courseanswer = mysqli_fetch_assoc($result3);
            $courseanswer2 = $courseanswer['CourseID'];
            $sql4 = "select Firstname, Lastname, Email, Phone, StudentID from studentdetails where CourseID = '$courseanswer2'";
            $result4 = mysqli_query($conn, $sql4);
            if ($result4) {
                if (mysqli_num_rows($result4) > 0) { ?>
            <div class="table-control" id="table-control">
                <h1>Attendance/Take Attendance</h1>
                <table border="1" cellspacing="6" cellpadding="6" id="my-table">
                    <tr class="heading">
                        <th>Sr no</th>
                        <th>StudentID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Attendance</th>


                    </tr>

                    <?php
                            $i = 1;
                            while ($result5 = mysqli_fetch_assoc($result4)) {
                            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result5['StudentID']; ?>
                            <input type="hidden" name="StudentID[]" value="<?php echo $result5['StudentID']; ?>" />
                        </td>
                        <td><?php echo $result5['Firstname']; ?></td>
                        <td><?php echo $result5['Lastname']; ?></td>
                        <td>
                            <!-- <div class="radio"> -->
                                <!-- <input type="radio" name=""
                                value="Present">Present</div>
                                <div class="radio">
                            <input type="radio" name="attendance_status[<?php /* echo $result5['StudentID'];  */?>]"
                                value="Absent">Absent</div> -->
                                <div class="wrapper">
                                    <div class="option">
                                        <input class="input" type="radio"
                                            name="attendance_status[<?php echo $result5['StudentID']; ?>]"
                                            value="Present" checked ="" >
                                        <div class="btn">
                                            <span class="span">Present</span>
                                        </div>
                                    </div>
                                    <div class="option">
                                        <input class="input" type="radio"
                                            name="attendance_status[<?php echo $result5['StudentID']; ?>]"
                                            value="Absent" >
                                        <div class="btn">
                                            <span class="span">Absent</span>
                                        </div>
                                    </div>
                                </div>
                            

                        </td>
                    </tr>
                    <?php
                                $i++;
                            }
                        } else {
                            echo "<div class='btndiv'>Data not found</div>";
                        }

                        ?>
                </table>
                <button type="submit" name="submit" class="button">Take Attendance</button>
                <?php

                 if(isset($_POST['submit'])) {
                  
    foreach($_POST['attendance_status'] as $studentid => $attendance_status) {
        $date = date("Y-m-d:H:i:s");
        $existing_attendance_query = "SELECT * FROM attendancedetails WHERE StudentID = '$studentid' AND Date = '$date'";
        $existing_attendance_result = mysqli_query($conn, $existing_attendance_query);
        if(mysqli_num_rows($existing_attendance_result) == 0) {
            // If no attendance exists, insert the new attendance record
            mysqli_query($conn,"INSERT INTO attendancedetails(SubjectID,StudentID,Date,Status) VALUES ('$subjectanswer2','$studentid','$date','$attendance_status')");
    }
}
    if($existing_attendance_result){
        echo "<div class='successmsg'>
                    <label class='successtext'>Attendance Recorded!</label>
        </div>";
    }
}}
?>
        </form>
    </section>

<script>
// Get references to the table and its container
const table = document.getElementById('my-table');
const container = document.getElementById('table-container');

// Function to adjust container height based on table height
function adjustContainerHeight() {
  container.style.height = table.offsetHeight + 'px';
}

// MutationObserver to observe changes in the table's child elements
const observer = new MutationObserver(() => {
  adjustContainerHeight();
});

// Configuration of the observer: observe changes in childList
const observerConfig = {
  childList: true
};

// Start observing the table
observer.observe(table, observerConfig);

// Call adjustContainerHeight initially
adjustContainerHeight();

</script>
</body>

</html>