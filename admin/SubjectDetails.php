<?php
include('components/dbconnection.php');
include('components/adminHeader.php');
include('components/sidebar.php');
$errors = [];

function sanitizeInput($data)
{
    global $con;
    return mysqli_real_escape_string($con, htmlspecialchars(strip_tags($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
        $sqlquery2 = "select TeacherID from teacherdetails where Username='$column2' ";
        $res2 = mysqli_query($con, $sqlquery2);
        $row2 = mysqli_fetch_array($res2);
        $subjectTeacher = $row2['TeacherID'];
        $sqlcoursecheck = "SELECT * FROM subjectdetails WHERE TeacherID='$subjectTeacher'";
        $courseresult = mysqli_query($con, $sqlcoursecheck);
        if (mysqli_num_rows($courseresult) > 0) {
            $errors['teacher'] = "This Teacher has already been assigned to a subject please choose another teacher";
        }
    
    if (empty($errors)) {

        $showdata = mysqli_real_escape_string($con, $_POST['selected_column1']);
        $sqlquery = "select CourseID from coursedetails where Coursename='$showdata' ";
        $res = mysqli_query($con, $sqlquery);
        $row = mysqli_fetch_array($res);
        $course = $row['CourseID'];

        $showdata2 = mysqli_real_escape_string($con, $_POST['selected_column2']);
        $sqlquery2 = "select TeacherID from teacherdetails where Username='$showdata2' ";
        $res2 = mysqli_query($con, $sqlquery2);
        $row2 = mysqli_fetch_array($res2);
        $subjectTeacher = $row2['TeacherID'];

        // Retrieve data from the form
        $subjectname = mysqli_real_escape_string($con, $_POST['subjectname']);
        $sqlcheck = "Select * from subjectdetails where CourseID = '$course' and TeacherID ='$subjectTeacher' and Subjectname = '$subjectname'";
        $rescheck = mysqli_query($con, $sqlcheck);
        if (mysqli_num_rows($rescheck) <= 0) {

            $sql = "INSERT INTO subjectdetails (CourseID, TeacherID, Subjectname)
                                        VALUES ('$course', '$subjectTeacher','$subjectname')";

            // Execute the query
            if ($con->query($sql) === TRUE) {
                $errors['subject-insertion'] =  "<div class='btndiv'><label class='form-text'>Data Inserted successfully</label></div>";
            } else {
                $errors['subject-insertion'] =  "<div class='btndiv'><label class='form-text'>Data wasn't Inserted </label></div>";
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
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
    <title>Course Details</title>
</head>

<body>
    <div class="mainpage">
        <div class="content-wrapper">
           
            <div class="page-header">
                <h3 class="pagetitle">Add Subjects</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <?php
                                $query = "select * from coursedetails";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<label for='columns' class='form-text'>Select a course:</label><br>";
                                    echo "<select id='showdata' name='selected_column1' value='" . (isset($_POST['selected_column1']) ? htmlspecialchars($_POST['selected_column1']) : '') . "' class='form-control'>";
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Coursename'] . "' class= 'option-control'>" . $row['Coursename'] . "</option>";
                                    }
                                    echo "</select>";
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $query = "select Username from teacherdetails";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<label for='columns' class='form-text'>Select the teacher u want to assign the subject:</label><br>";
                                    echo "<select id='showdata' name='selected_column2' value='" . (isset($_POST['selected_column2']) ? htmlspecialchars($_POST['selected_column2']) : '') . "' class= 'form-control'>";
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Username'] . "' class= 'option-control'>" . $row['Username'] . "</option>";
                                    }
                                    echo "</select>";
                                } else {
                                    echo "0 results";
                                }
                                ?>
                                <?php if (isset($errors['teacher'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['teacher']}</span></div>"; ?>
                            </div>
                            <div class="form-group">
                                <label class="form-text">Subject Name</label>
                                <input type="text" name="subjectname" id="errormsg" value="" class="form-control" required='true'>
                                <div class="errormsgcss"><span id="errorf" class="errormsg"></span></div>
                            </div>

                            <div class="btndiv"><button class="btn" name="submit2" value="submit">Add Subject</button>
                            </div>
                            <?php if (isset($errors['subject-insertion'])) echo "<div class='btndiv'>{$errors['subject-insertion']}</div>"; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="admin.js">

    </script>
</body>


</html>