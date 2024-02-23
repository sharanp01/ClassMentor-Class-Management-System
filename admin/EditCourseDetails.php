<?php
include('components/dbconnection.php');
include('components/adminHeader.php');
include('components/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
    <title>Edit Course</title>
</head>
<body>
<div class="mainpage">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="pagetitle">Edit Course Details</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <label class="form-text">Enter Coursename</label>
                                <input type="text" name="coursename" id="username" value="" class="form-control" required='true'>
                            </div>
                            <div class="form-group">
                                <?php
                                $tableName = 'Coursedetails';
                                $query = "SHOW COLUMNS FROM $tableName";
                                $result = mysqli_query($con, $query);

                                // Check if there are any columns
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<label for='columns' class='form-text'>Select a column:</label><br>";
                                    echo "<select id='showdata' name='selected_column' class= 'form-control'>";
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Field'] . "' class= 'option-control'>" . $row['Field'] . "</option>";
                                    }
                                    echo "</select>";
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="form-text">New Data</label>
                                <input type="text" name="newdata" id="newdata" value="" class="form-control" required='true' oninput="validateEditInputs()">
                                <div class="errormsgcss"><span id="errormsg" class="errormsg"></span></div>
                            </div>

                            <div class="btndiv"><button class="btn" name="submit" value="submit">Edit Data</button>
                            </div>
                        </form>
                        <?php

                            if (isset($_POST["submit"])) {
                                if (isset($_POST['coursename']) && isset($_POST['selected_column']) && isset($_POST['newdata'])) {
                                    $coursename = $_POST['coursename'];
                                    $selectedc = $_POST['selected_column'];
                                    $newd = $_POST['newdata'];
                                    $sql1 = "SELECT Coursename FROM coursedetails WHERE Coursename = '$coursename'";
                                    $res = mysqli_query($con, $sql1);
                                    if (mysqli_num_rows($res) == 0) {
                                        echo "<label class='form-text'>User not found</label>";
                                    } else {
                                            $sql2 = "UPDATE coursedetails SET `$selectedc` = '$newd' WHERE Coursename = '$coursename' ";
                                            if (mysqli_query($con, $sql2)) {
                                                echo "<div class='btndiv'><label class='form-text'>Record updated Successfully</label></div>";
                                            } else {
                                                echo "Error updating record: " . mysqli_error($con);
                                            }
                                        }
                                } else {
                                    echo "<label class='form-text'>Please enter the data</label>";
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <h3 class="pagetitle">Edit Subject Details</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <label class="form-text">Enter Subjectname</label>
                                <input type="text" name="subjectname" id="username" value="" class="form-control" required='true'>
                            </div>
                            <div class="form-group">
                                <?php
                                $tableName = 'subjectdetails';
                                $query = "SHOW COLUMNS FROM $tableName";
                                $result = mysqli_query($con, $query);

                                // Check if there are any columns
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<label for='columns' class='form-text'>Select a column:</label><br>";
                                    echo "<select id='showdata' name='selected_column' class= 'form-control'>";
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Field'] . "' class= 'option-control'>" . $row['Field'] . "</option>";
                                    }
                                    echo "</select>";
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="form-text">New Data</label>
                                <input type="text" name="newdata" id="newdata" value="" class="form-control" required='true' oninput="validateEditInputs()">
                                <div class="errormsgcss"><span id="errormsg" class="errormsg"></span></div>
                            </div>

                            <div class="btndiv"><button class="btn" name="submit2" value="submit">Edit Data</button>
                            </div>
                        </form>
                        <?php

                            if (isset($_POST["submit2"])) {
                                if (isset($_POST['subjectname']) && isset($_POST['selected_column']) && isset($_POST['newdata'])) {
                                    $subjectname = $_POST['subjectname'];
                                    $selectedc = $_POST['selected_column'];
                                    $newd = $_POST['newdata'];
                                    $sql1 = "SELECT Subjectname FROM subjectdetails WHERE Subjectname = '$subjectname'";
                                    $res = mysqli_query($con, $sql1);
                                    if (mysqli_num_rows($res) == 0) {
                                        echo "<label class='form-text'>User not found</label>";

                                    } else {
                                            if ($selectedc == "CourseID") {
                                            $sqlquery = "SELECT CourseID FROM coursedetails WHERE Coursename='$newd'";
                                            $result = mysqli_query($con, $sqlquery);
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_array($result);
                                                $studentcourse = $row['CourseID'];
                                                $sql2 = "UPDATE subjectdetails SET CourseID = '$studentcourse' WHERE Subjectname = '$subjectname' ";
                                                if (mysqli_query($con, $sql2)) {
                                                    echo "<div class='btndiv'><label class='form-text'>Record updated Successfully</label></div>";
                                                } else {
                                                    echo "Error updating record: " . mysqli_error($con);
                                                }
                                            } else {
                                                echo "Error: Course not found in coursedetails table";
                                            }
                                        } elseif($selectedc == "TeacherID")
                                        {
                                            $sqlquery = "SELECT TeacherID FROM teacherdetails WHERE Username='$newd'";
                                            $result = mysqli_query($con, $sqlquery);
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_array($result);
                                                $studentcourse = $row['TeacherID'];
                                                $sql2 = "UPDATE subjectdetails SET TeacherID = '$studentcourse' WHERE Subjectname = '$subjectname' ";
                                                if (mysqli_query($con, $sql2)) {
                                                    echo "<div class='btndiv'><label class='form-text'>Record updated Successfully</label></div>";
                                                } else {
                                                    echo "Error updating record: " . mysqli_error($con);
                                                }
                                            } else {
                                                echo "Error: Teacher not found in Teacher table";
                                            }
                                        }
                                         else {
                                            $sql2 = "UPDATE subjectdetails SET `$selectedc` = '$newd' WHERE Subjectname = '$subjectname' ";
                                            if (mysqli_query($con, $sql2)) {
                                                echo "<div class='btndiv'><label class='form-text'>Record updated Successfully</label></div>";
                                            } else {
                                                echo "Error updating record: " . mysqli_error($con);
                                            }
                                        }
                                        }
                                } else {
                                    echo "<label class='form-text'>Please enter the data</label>";
                                }
                            }
                            ?>
                    </div>
                </div>
        </div>
</div>
</body>
</html>