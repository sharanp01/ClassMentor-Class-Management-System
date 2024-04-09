<?php
include("components/connect.php");
include("components/sidebar.php");
$username = "sathya05";
$studentsql = "select * from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];
$studid = $row1['StudentID'];
$errors = [];
function sanitizeInput($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $feedback = sanitizeInput($_POST['feedback']);
    if (strlen($feedback) > 200) {
        $errors['feedback'] = "Feedback must be 200 characters or less";
    }

    $suggestion = sanitizeInput($_POST['suggestion']);
    if (strlen($suggestion) > 200) {
        $errors['suggestion'] = "Suggestion must be 200 characters or less";
    }
    if (empty($errors)) {
        $showdata = $_POST['selected_column1'];
        $feedback = $_POST['feedback'];
        $suggestion = $_POST['suggestion'];
        $teachersql = "SELECT TeacherID FROM teacherdetails WHERE Username = '$showdata'";
        $teacheresult = mysqli_query($conn, $teachersql);
        $row2 = mysqli_fetch_assoc($teacheresult);
        $teacherid = $row2['TeacherID'];
        $sqlcheck = "Select * from feedbackdetails where StudentID = '$studid' and Suggestion = '$suggestion'";
        $rescheck = mysqli_query($conn, $sqlcheck);
        if (mysqli_num_rows($rescheck) <= 0) {
            // SQL query to insert data into the database
            $sql = "INSERT INTO feedbackdetails(StudentID, TeacherID , CourseID, Feedback, Suggestion) VALUES ('$studid','$teacherid','$col1','$feedback','$suggestion')";
            if ($conn->query($sql) === TRUE) {
                $errors['feedback-insertion'] = "<div class='btndiv centerdiv'><label class='form-text'>Suggestion Submitted Successfully!</label></div>";
            } else {
                $errors['feedback-insertion'] = "<div class='btndiv centerdiv'><label class='form-text'>Suggestion wasn't submitted!</label></div>";
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
    <link rel="stylesheet" href="styles/studentstyle.css">
    <title>Document</title>
</head>

<body>
    <section class="home-section">
        <div class="home-content">
            <div class="left-content">
                ClassMentor
            </div>
            <div class="right-content">
                <label for="" class="dropdowntext" style="margin-right: 30px;">Welcome sathya04</label>
                <div class="dropdown">
                    <div class="dropdown">
                        <a href="logout.php"><button class="Btn">
                                <div class="sign"><svg viewBox="0 0 512 512">
                                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                    </svg></div>
                                <div class="text">Logout</div>
                            </button>
                        </a>
                    </div>s
                </div>
            </div>
        </div>
        </div>
        <div class="resource-control">
            <h1>Feedback Section</h1>
            <form action="" method="post">
                <div class="resinput">
                    <label for="">Select Teacher's Name:</label><br>
                    <?php
                    $query = "SELECT teacherdetails.Username FROM subjectdetails
                    INNER JOIN teacherdetails ON teacherdetails.TeacherID = subjectdetails.TeacherID
                    WHERE CourseID =  '$col1'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<select id='showdata' name='selected_column1' class= 'dropdowncontrol'>";
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['Username'] . "' class= 'option-control'>" . $row['Username'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>
                <div class="resinput">
                    <label for="">Enter feedback based on the Performance:</label> <br>
                    <textarea name="feedback" id="" cols="60" value="<?= isset($_POST['feedback']) ? htmlspecialchars($_POST['feedback']) : ''; ?>" rows="3" placeholder="Character limit: 200 words" required></textarea><br>
                    <?php if (isset($errors['feedback'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['feedback']}</span></div>"; ?>

                </div>
                <div class="resinput" style="margin-top:15px;">
                    <label for="">Enter Suggestion for Improvement:</label> <br>
                    <textarea name="suggestion" value = "<?= isset($_POST['suggestion']) ? htmlspecialchars($_POST['suggestion']) : ''; ?> " id="" cols="60" rows="3" placeholder="Character limit: 200 words" required></textarea><br>
                    <?php if (isset($errors['suggestion'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['suggestion']}</span></div>"; ?>
                </div>
                <div class="btndic centerdiv">
                    <button name="submit" class="button">Submit</button>
                    <?php if (isset($errors['feedback-insertion'])) echo "{$errors['feedback-insertion']}"; ?>
                </div>
            </form>
            
        </div>
    </section>
</body>

</html>