<?php
include("components/connect.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Document</title>
    <style> body{ background-color:#E4E9F7  ;}</style>
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
            <h1>Assignment/Add Assignment</h1>
            <form action="" method="post">
                <div class="resinput">
                    <label for="">Add Assignment Question:</label> <br>
                    <textarea name="assignquestion" id="" cols="60" rows="3" required></textarea><br>
                </div>
                <div class="resinput">
                    <label for="">Add Assignment Weightage</label> <br>
                    <input type="text" name="assignweightage" id="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Add Assignment Submission Date</label> <br>
                    <input type="date" name="assignsubdate" id="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Add Assignment Submission Link</label> <br>
                    <input type="text" name="assignsublink" id="resname" required><br>
                </div>
                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button" onclick="clearForm()">Post Assignment</button>
                    <?php
                    if (isset($_POST["submit"])) {
                        $assignquestion = $_POST['assignquestion'];
                        $assignweightage = $_POST['assignweightage'];
                        $assignsubdate = $_POST['assignsubdate'];
                        $assignsublink = $_POST['assignsublink'];
                        $sql = "Insert into assignmentdetails (TeacherID,SubjectID, Assignmentquestion, Assignmentweightage, AssignmentSubdate, AssignmentSublink) values('$answer2','$subjectanswer2','$assignquestion','$assignweightage','$assignsubdate','$assignsublink')";
                        if ($conn->query($sql) == TRUE) {
                            echo "<div class='successmsg'>
                            <label class='successtext'>Assignment Posted!</label>
                </div>";
                        } else {
                            echo "<div class='successmsg'>
                            <label class='successtext'>Assignment Was'nt Posted!</label>
                </div>";
                        }
                    }

                    ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>