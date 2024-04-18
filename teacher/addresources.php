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
                            $targetDir = "uploads/";

                            $fileName = basename($_FILES["fileToUpload"]["name"]);


                            $targetFilePath = $targetDir . $fileName;
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                                $sql = "INSERT INTO resourcedetails (Resourcename,CourseID,Resourcedesc,filename ,filepath) VALUES ('$resname','$courseanswer2','$resdesc','$fileName', '$targetFilePath')";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='successmsg'>
                    <label class='successtext'>Resource File Added</label>
        </div>";
                                } else {
                                    $flag = 0;
                                    echo "<div class='successmsg'>
                                <label class='successtext'>Resource File wasnt Added</label>
                    </div>";
                                }
                            } else {
                                echo "<div class='successmsg'>
                            <label class='successtext'>Resource File Uploaded Already, Please Add a new File to Upload</label>
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