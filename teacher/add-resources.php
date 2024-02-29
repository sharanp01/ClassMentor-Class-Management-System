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
$sql3 = "select CourseID from subjectdetails where SubjectID = '$subjectanswer2'";
$result3 = mysqli_query($conn, $sql3);
$courseanswer = mysqli_fetch_assoc($result3);
$courseanswer2 = $courseanswer['CourseID'];
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
            <h1 class="heading-text">Resources/Add Resources</h1>
            <form action="" method="post" enctype="multipart/form-data" id="myForm">
                <div class="resinput">
                    <label for="">Enter Resource Name:</label><br>
                    <input type="text" name="resname" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Resource Description:</label> <br>
                    <textarea name="resdesc" id="" cols="60" rows="3" required></textarea><br>
                </div>
                <div class="resinput"> <label for="fileToUpload">Add Resource File</label><br>
                    <input type="file" name="fileToUpload" id="fileToUpload" required><br>
                </div>

                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button" onclick="clearForm()">Upload Resource</button>
                    <?php
                    if (isset($_POST["submit"])) {
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
                                $sql = "INSERT INTO resourcedetails (Resourcename,CourseID,Resourcedesc,filename ,filepath,Studentfilepath) VALUES ('$resname','$courseanswer2','$resdesc','$fileName', '$targetFilePathTeacher','$targetFilePathStudent')";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='successmsg'>
                                        <label class='successtext'>Resource File Added</label>
                                    </div>";
                                } else {
                                    echo "<div class='successmsg'>
                                        <label class='successtext'>Resource File wasn't Added</label>
                                    </div>";
                                }
                            } else {
                                echo "<div class='successmsg'>
                                    <label class='successtext'>Failed to copy file to student's folder</label>
                                </div>";
                            }
                        } else {
                            echo "<div class='successmsg'>
                                <label class='successtext'>Failed to upload file to teacher's folder</label>
                            </div>";
                        }
                    }

                    ?>
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