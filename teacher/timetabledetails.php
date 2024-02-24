<?php
include('components/connect.php');
include('components/sidebar.php');
$username = "Divya01";
$sql = "select * from teacherdetails where Username= '$username' ";
$result = mysqli_query($conn, $sql);
$answer = mysqli_fetch_assoc($result);
$answer2 = $answer['TeacherID'];
$sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
$result2 = mysqli_query($conn, $sql2);
$subjectanswer = mysqli_fetch_assoc($result2);
$subjectanswer2 = $subjectanswer['SubjectID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="resource-control">
            <h1 class="heading-text">Timetable/Schedule Lecture</h1>
            <form action="" method="post" enctype="multipart/form-data" id="myForm">
                <div class="resinput">
                    <label for="">Enter Date:</label><br>
                    <input type="date" name="timetabledate" id="timetabledate" class="resname" oninput=validateDate() required>
                    <span id="dateError" style="color: red; font-size: 1rem; position: relative; left: 10px;"></span><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Lecture Start Time:</label> <br>
                    <input type="time" name="timetablestarttime" id="timetablestarttime" class="resname" required><br>

                </div>
                <div class="resinput">
                    <label for="">Enter Lecture End Time:</label> <br>
                    <input type="time" name="timetableendtime" id="timetableendtime" class="resname" oninput="validateTime()" required>
                    <span id="timeError" style="color: red; font-size: 1rem; position: relative; left: 10px;"></span><br>
                </div>

                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button">Schedule Lecture</button>
                    <?php
                    if (isset($_POST['submit'])) {
                        $date = $_POST['timetabledate'];
                        $starttime = $_POST['timetablestarttime'];
                        $endtime = $_POST['timetableendtime'];
                        $sql = "Insert into timetabledetails (TeacherID, SubjectID, Date, Starttime, Endtime) values('$answer2','$subjectanswer2','$date','$starttime','$endtime')";
                        if ($conn->query($sql) == TRUE) {
                            echo "<div class='successmsg'>
                       <label class='successtext'>Lecture Scheduled!</label>
           </div>";
                        } else {
                            echo "<div class='successmsg'>
                       <label class='successtext'>Lecture Was'nt Scheduled!</label>
           </div>";
                        }
                    }
                    ?>
                </div>
    </section>
</body>
<script>
    function validateDate() {
        var selectedDate = new Date(document.getElementById("timetabledate").value);
        var currentDate = new Date();

        if (selectedDate < currentDate) {
            document.getElementById("dateError").innerText = "Please select a date equal to or after the current date.";
        } else {
            // Reset error message
            document.getElementById("dateError").innerText = "";
        }
    }

    function validateTime() {
        var startTimeInput = document.getElementById("timetablestarttime").value;
        var endTimeInput = document.getElementById("timetableendtime").value;
        var startTime = new Date("2000-01-01 " + startTimeInput);
        var endTime = new Date("2000-01-01 " + endTimeInput);

        // Check if end time is before start time
        if (endTime < startTime) {
            document.getElementById("timeError").innerText = "End time must be after start time.";
        } else {
            // Reset error message
            document.getElementById("timeError").innerText = "";
        }
    }
</script>

</html>