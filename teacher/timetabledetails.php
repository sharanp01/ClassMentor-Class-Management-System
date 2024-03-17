<?php
include('components/connect.php');
include('components/sidebar.php');
$username = "sharan01";
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
    <title>Timetable</title>

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
                    <a href="logout.php"><button class="Btn">
                            <div class="sign"><svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg></div>
                            <div class="text">Logout</div>
                        </button>
                    </a>
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
                        $sqlcheck = "Select * from timetabledetails where Date = '$date' and SubjectID = '$subjectanswer2'";
                        $rescheck = mysqli_query($conn, $sqlcheck);
                        if (mysqli_num_rows($rescheck) <= 0) {
                            $sql = "Insert into timetabledetails (TeacherID, CourseID,SubjectID, Date, Starttime, Endtime) values('$answer2','$courseanswer2','$subjectanswer2','$date','$starttime','$endtime')";
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