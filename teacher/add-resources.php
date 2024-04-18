<?php
session_start();
include("components/connect.php");
include('components/sidebar.php');
if (isset($_SESSION['username'])) {
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

        $resname = sanitizeInput($_POST['resname']);
        if (strlen($resname) > 100) {
            $errors['resname'] = "Resource Name must be 100 characters or less";
        }

        $resdesc = sanitizeInput($_POST['resdesc']);
        if (strlen($resdesc) > 200) {
            $errors['resdesc'] = "Resource Description must be 200 characters or less";
        }
        if (empty($errors)) {
            $resname = $_POST['resname'];
            $resdesc = $_POST['resdesc'];
            $targetDirTeacher = "uploads/"; // Teacher's upload folder
            $targetDirStudent = "C:/xampp/htdocs/cms/student/uploads/";

            $fileName = basename($_FILES["fileToUpload"]["name"]);

            // Teacher's directory path
            $targetFilePathTeacher = $targetDirTeacher . $fileName;
            // Student's directory path
            $targetFilePathStudent = $targetDirStudent . $fileName;

            // Upload to Teacher's folder
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePathTeacher)) {
                // Upload to Student's folder
                if (copy($targetFilePathTeacher, $targetFilePathStudent)) {
                    $resname = mysqli_real_escape_string($conn, $resname);
                    $resdesc = mysqli_real_escape_string($conn, $resdesc);
                    $fileName = mysqli_real_escape_string($conn, $fileName);
                    $sqlcheck = "SELECT * FROM resourcedetails WHERE Resourcename = '$resname' AND Resourcedesc = '$resdesc' AND filename = '$fileName'";
                    $rescheck = mysqli_query($conn, $sqlcheck);
                    if (mysqli_num_rows($rescheck) <= 0) {
                        $sql = "INSERT INTO resourcedetails (Resourcename,CourseID,Resourcedesc,filename ,filepath,Studentfilepath) VALUES ('$resname','$courseanswer2','$resdesc','$fileName', '$targetFilePathTeacher','$targetFilePathStudent')";
                        if ($conn->query($sql) === TRUE) {
                            $errors['resource-insertion']  = "<div class='successmsg'>
                    <label class='successtext'>Resource File Added</label>
                </div>";
                        } else {
                            $errors['resource-insertion']  = "<div class='successmsg'>
                    <label class='successtext'>Resource File wasn't Added</label>
                </div>";
                        }
                    }
                } else {
                    $errors['resource-insertion']  = "<div class='successmsg'>
                <label class='successtext'>Failed to copy file to student's folder</label>
            </div>";
                }
            } else {
                $errors['resource-insertion']  = "<div class='successmsg'>
            <label class='successtext'>Failed to upload file to teacher's folder</label>
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
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Add Resources</title>
</head>

<body>
    <section class="home-section">

        <div class="home-content">
            <div class="left-content">
                ClassMentor
            </div>
            <div class="right-content">

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
            <h1 class="heading-text">Resources/Add Resources</h1>
            <form action="" method="post" enctype="multipart/form-data" id="myForm">
                <div class="resinput">
                    <label for="">Enter Resource Name:</label><br>
                    <input type="text" name="resname" placeholder="Character limit: 100 Words" value="<?= isset($_POST['resname']) ? htmlspecialchars($_POST['resname']) : ''; ?>" id="resname" class="resname" required><br>
                    <?php if (isset($errors['resname'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['resname']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Resource Description:</label> <br>
                    <textarea name="resdesc" placeholder="Character limit: 200 Words" value="<?= isset($_POST['resdesc']) ? htmlspecialchars($_POST['resdesc']) : ''; ?>" id="" cols="60" rows="3" required></textarea><br>
                    <?php if (isset($errors['resdesc'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['resdesc']}</span></div>"; ?>

                </div>
                <div class="resinput"> <label for="fileToUpload">Add Resource File</label><br>
                    <input type="file" name="fileToUpload" id="fileToUpload" required><br>
                </div>

                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button" onclick="clearForm()">Upload Resource</button>
                    <?php if (isset($errors['resource-insertion'])) echo "{$errors['resource-insertion']}"; }?>
                </div>

            </form>
        </div>
    </section>
    <script>
        window.onload = function() {
            // Get the form element
            var form = document.getElementById("myForm");
            // Reset the form
            form.reset();
        };
    </script>

</body>

</html>