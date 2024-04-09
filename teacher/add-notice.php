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
$errors = [];
function sanitizeInput($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $announcetitle = sanitizeInput($_POST['announcetitle']);
    if (strlen($announcetitle) > 50) {
        $errors['announcetitle'] = "Announcement Title must be 50 characters or less";
    }

    $announcedesc = sanitizeInput($_POST['announcedesc']);
    if (strlen($announcedesc) > 150) {
        $errors['announcedesc'] = "Announcement Description must be 150 characters or less";
    }
    if (empty($errors)) {
        $title = $_POST['announcetitle'];
        $desc = $_POST['announcedesc'];
        $sqlcheck = "Select * from announcementdetails where Announcementtitle = '$title' and AnnouncementDesc = '$desc'";
        $rescheck = mysqli_query($conn, $sqlcheck);
        if (mysqli_num_rows($rescheck) <= 0) {
            $sql = "Insert into announcementdetails (SubjectID, Announcementtitle, AnnouncementDesc,CourseID) values('$subjectanswer2','$title','$desc','$courseanswer2')";
            if ($conn->query($sql) == TRUE) {
                $errors['announcement-insertion'] = "<div class='successmsg'>
            <label class='successtext'>Announcement Posted!</label>
</div>";
            } else {
                $errors['announcement-insertion'] = "<div class='successmsg'>
            <label class='successtext'>Announcement Was'nt Posted!</label>
</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notice</title>
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
        </div>
        <div class="resource-control">
            <h1 class="heading-text">Notice/Add Notice</h1>
            <form action="" method="post">
                <div class="resinput">
                    <label for="">Enter Announcement Title:</label><br>
                    <input type="text" name="announcetitle" placeholder= "Character Limit: 50 Words" value="<?= isset($_POST['announcetitle']) ? htmlspecialchars($_POST['announcetitle']) : ''; ?>" id="resname" class="resname" required><br>
                    <?php if (isset($errors['announcetitle'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['announcetitle']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Announcement:</label> <br>
                    <textarea name="announcedesc" placeholder= "Character Limit: 150 Words" value="<?= isset($_POST['announcedesc']) ? htmlspecialchars($_POST['announcedesc']) : ''; ?>"id="" cols="60" rows="3" required></textarea><br>
                    <?php if (isset($errors['announcedesc'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['announcedesc']}</span></div>"; ?>
                </div>
                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button">Post Announcement</button>
                    <?php if (isset($errors['announcement-insertion'])) echo "{$errors['announcement-insertion']}"; ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>