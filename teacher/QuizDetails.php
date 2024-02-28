<?php
include("components/sidebar.php");
include("components/connect.php");
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
    <style>
        a {
            color: black;
        }

        a:hover {
            color: grey;
        }
    </style>
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
            <div class="left-content">
                <h1 class="heading-text">Test/Add Test</h1>
            </div>
            <form action="" method="post">
                <div class="resinput">
                    <label for="">Enter Quiz Topic:</label><br>
                    <input type="text" name="Quiztopic" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Difficulty Level:</label><br>
                    <input type="text" name="difflevel" id="resname" class="resname" required><br>
                </div>
                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button">Add Test</button>

                    <?php
                    if (isset($_POST['submit'])) {
                        $topic = $_POST['Quiztopic'];
                        $diff = $_POST['difflevel'];
                        $sql = "Insert into quiztopic (SubjectID, Quiztopic, Difficulty) values('$subjectanswer2','$topic','$diff')";
                        if ($conn->query($sql) == TRUE) {
                            echo "<div class='successmsg'>
                            <label class='successtext'>Test Created!</label>
                </div>";
                        } else {
                            echo "<div class='successmsg'>
                            <label class='successtext'>Test Was'nt Created!</label>
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