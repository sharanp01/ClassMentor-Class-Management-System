<?php
session_start();
include("components/adminHeader.php");
include("components/sidebar.php");
include("components/dbconnection.php");
if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap");

        .announcement-label {
            --input-focus: #2d8cf0;
            --font-color: #323232;
            --font-color-sub: #666;
            --bg-color: #fff;
            --main-color: #323232;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            background-color: var(--bg-color);
            font-size: 1rem;
            font-weight: 600;
            color: var(--font-color);
            padding: 10px 5px;
            outline: none;
            margin-top: 5px;
            margin-left: 7px;
            margin-bottom: 20px;

        }

        .announce-space {
            margin-bottom: 10px;
        }

        .announcement-label p {
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
            margin-top: 5px;
            font-size: 1.1rem;
            font-weight: none;
            font-family: "Montserrat", sans-serif;

        }

        .announce-desc {
            font-size: 1rem;
            margin-left: 15px;
            font-weight: none;
            font-family: "Montserrat", sans-serif;
        }

        .assign-text {
            color: red;
        }
    </style>
</head>

<body>
    <div class="mainpage">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="pagetitle">View Feedback</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <label class="form-text">Select teacher's username to viewfeedback</label>
                                <?php
                                $query = "SELECT * from teacherdetails";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<select id='showdata' name='selected_column1' class= 'form-control'>";
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
                            <div class="btndiv"><button class="btn" name="submit" value="submit">View feedback</button>
                            </div>
                            <div class="feedbackdiv">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $showdata = $_POST['selected_column1'];
                                    $teacheridsql = "SELECT TeacherID FROM teacherdetails WHERE Username = '$showdata'";
                                    $resultsql = mysqli_query($con, $teacheridsql);
                                    $row = mysqli_fetch_assoc($resultsql);
                                    $teacherid = $row['TeacherID'];
                                    $feedbacksql = "SELECT * FROM feedbackdetails WHERE TeacherID = '$teacherid'";
                                    $result = mysqli_query($con, $feedbacksql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $studentid = $row['StudentID'];
                                            $studentsql = "SELECT Username FROM studentdetails WHERE StudentID = '$studentid'";
                                            $resultsql2 = mysqli_query($con, $studentsql);
                                            $row2 = mysqli_fetch_assoc($resultsql2);
                                            $username =$row2['Username'];
                                            $feedback = ucwords($row['Feedback']); 
                                            $suggestion = ucwords($row['Suggestion']); 
                                            echo "<div  class='announcement-label'>
                                                <div class='announce-desc'><p>Feedback: </p><label  class='assign-text'>" . $feedback . "</label><br></div>
                                                <div class='announce-desc'><p>Suggestion for Improvement: </p><label  class='assign-text'>" .$suggestion . "</label><br></div>
                                                <div class='announce-desc'><p>Feedback Given by: </p><label  class='assign-text'>" . $username . "</label><br></div></div>";
                                        }
                                    } else {
                                        echo "<div class='btndiv'><label class='successtext'>feedback not found</label></div>";
                                    }
                                }
                            }
                            else{
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

</body>

</html>