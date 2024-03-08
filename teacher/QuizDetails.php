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
    <title>Test</title>
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
            <h1 class="heading-text">Test/Add Test</h1>
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