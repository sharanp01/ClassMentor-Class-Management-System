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
    <title>Edit Student</title>
</head>

<body>
    <div class="mainpage">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="pagetitle">Edit Student Details</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <label class="form-text">Enter Username</label>
                                <input type="text" name="username" id="username" value="" class="form-control" required='true'>
                            </div>
                            <div class="form-group">
                                <?php
                                $tableName = 'studentdetails';
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

                            <?php

                            if (isset($_POST["submit"])) {
                                if (isset($_POST['username']) && isset($_POST['selected_column']) && isset($_POST['newdata'])) {
                                    $username = $_POST['username'];
                                    $selectedc = $_POST['selected_column'];
                                    $newd = $_POST['newdata'];
                                    $sql1 = "SELECT Username FROM studentdetails WHERE Username = '$username'";
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
                                                $sql2 = "UPDATE studentdetails SET CourseID = '$studentcourse' WHERE Username = '$username' ";
                                                if (mysqli_query($con, $sql2)) {
                                                    echo "<div class='btndiv'><label class='form-text'>Record updated Successfully</label></div>";
                                                } else {
                                                    echo "<div class='btndiv'>Error updating record </div>";
                                                }
                                            } else {
                                                echo "<div class='btndiv'>Error: Course not found in coursedetails table</div>";
                                            }
                                        } else {
                                            $sql2 = "UPDATE studentdetails SET `$selectedc` = '$newd' WHERE Username = '$username' ";
                                            if (mysqli_query($con, $sql2)) {
                                                echo "<div class='btndiv'><label class='form-text'>Record updated Successfully</label></div>";
                                            } else {
                                                echo "<div class='btndiv'>Error updating record </div> " ;
                                            }
                                        }
                                    }
                                } else {
                                    echo "<div class='btndiv'><label class='form-text'>Please enter the data</label></div>";
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="admin.js"></script>
</body>

