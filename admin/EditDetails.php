<?php
session_start();
include('components/dbconnection.php');
include('components/adminHeader.php');
include('components/sidebar.php');
if (isset($_SESSION['username'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
        <title>Edit Teacher</title>
    </head>

    <body>
        <div class="mainpage">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="pagetitle">Edit Teacher Details</h3>
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
                                    $tableName = 'teacherdetails';
                                    $query = "SHOW COLUMNS FROM $tableName";
                                    $result = mysqli_query($con, $query);

                                    // Check if there are any columns
                                    if (mysqli_num_rows($result) > 0) {
                                        echo "<label for='columns' class='form-text'>Select a column:</label><br>";
                                        echo "<select id='showdata' name='selected_column' class= 'form-control'>";
                                        // Output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['Field'] == 'TeacherID' || $row['Field'] == 'code' || $row['Field'] == 'Password') {
                                                continue;
                                            }
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
                                <div class="btndiv">
                                <?php

                                if (isset($_POST["submit"])) {
                                    if (isset($_POST['username']) && isset($_POST['selected_column']) && isset($_POST['newdata'])) {
                                        $username = $_POST['username'];
                                        $selectedc = $_POST['selected_column'];
                                        $newd = $_POST['newdata'];
                                        $sql1 = "Select Username from teacherdetails where Username = '$username'";
                                        $res = mysqli_query($con, $sql1);
                                        if (mysqli_num_rows($res) == 0) {
                                            echo "<label class='form-text'>User not found</label>";
                                        } else {
                                            $sql2 = "UPDATE teacherdetails SET `$selectedc` = '$newd' WHERE Username = '$username' ";
                                            if (mysqli_query($con, $sql2)) {
                                                echo "<label class='form-text'>Record updated Successfully</label>";
                                            } else {
                                                echo "Error updating record: " . mysqli_error($con);
                                            }
                                        }
                                    } else {
                                        echo "<label class='form-text'>Please enter the data</label>";
                                    }
                                }
                            } else {
                                header("Location:index.php");
                            }
                                ?>
                                </div>
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