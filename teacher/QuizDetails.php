<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include("components/sidebar.php");
include("components/connect.php");
    $username = $_SESSION['username'];
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
    $errors = [];
    function sanitizeInput($data)
    {
        global $conn;
        return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $topic = sanitizeInput($_POST['Quiztopic']);
        if (strlen($topic) > 50) {
            $errors['quiztopic'] = "Topic must be 50 characters or less";
        }

        if (empty($errors)) {
            $topic = mysqli_real_escape_string($conn,  $_POST['Quiztopic']);;
            $diff = mysqli_real_escape_string($conn,  $_POST['difflevel']);;
            $sql = "Insert into quiztopic (CourseID, SubjectID, Quiztopic, Difficulty) values('$courseanswer2','$subjectanswer2','$topic','$diff')";
            if ($conn->query($sql) == TRUE) {
                $errors['quiztopic-insertion'] = "<div class='successmsg'>
            <label class='successtext'>Test Created!</label>
</div>";
            } else {
                $errors['quiztopic-insertion'] = "<div class='successmsg'>
            <label class='successtext'>Test Was'nt Created!</label>
</div>";
            }
        }
    }

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
                        <input type="text" name="Quiztopic" value="<?= isset($_POST['Quiztopic']) ? htmlspecialchars($_POST['Quiztopic']) : ''; ?> " id="resname" class="resname" placeholder="Character Limit: 50"><br>
                        <?php if (isset($errors['quiztopic'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['quiztopic']}</span></div>"; ?>
                    </div>
                    <div class="resinput">
                        <label for="">Enter Difficulty Level:</label><br>
                        <input type="text" name="difflevel" id="resname" class="resname" required><br>
                    </div>
                    <div class="btndiv centerdiv">
                        <button type="submit" name="submit" id="button" class="button">Add Test</button>
                    <?php if (isset($errors['quiztopic-insertion'])) echo "{$errors['quiztopic-insertion']}";
                 ?>
                    </div>
                </form>
            </div>
        </section>
    </body>

    </html>