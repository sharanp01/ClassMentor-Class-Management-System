<?php
include('components/connect.php');
include('components/sidebar.php');
$username = "Divya01";
$sql = "select * from teacherdetails where Username= '$username' ";
$result = mysqli_query($conn, $sql);
$answer = mysqli_fetch_assoc($result);
$answer2 = $answer['TeacherID'];
$assignsql = "Select * from assignmentdetails where TeacherID='$answer2'";
$assignresult = mysqli_query($conn, $assignsql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .assignment-label {
            --input-focus: #2d8cf0;
            --font-color: #323232;
            --font-color-sub: #666;
            --bg-color: #fff;
            --main-color: #323232;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            background-color: var(--bg-color);
            box-shadow: 4px 4px var(--main-color);
            font-size: 1rem;
            font-weight: 600;
            color: var(--font-color);
            padding: 10px 10px;
            outline: none;
            margin-top: 5px;
            margin-left: 7px;
            margin-bottom: 20px;
        }

        .assign-space {
            margin-bottom: 10px;
        }

        .assignment-label p {
            display: inline-block;
            margin-right: 5px;
        }

        .assignment-label a {
            display: block;
        }
    </style>
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
            <h1 class="heading-text">Assignment/Manage Assignment</h1>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = $assignresult->fetch_assoc()) {
                    echo "<div  class='assignment-label'><div class='assign-space'><p>Assignment Question: </p> <label for='question-" . $row['AssignmentID'] . "'  class='assign-text'>" . $row['Assignmentquestion'] . "</label><br></div>
                    <div class='assign-space'><p>Assignment Submission Date: </p><label for='question-" . $row['AssignmentID'] . "' class='assign-text'>" . $row['AssignmentSubdate'] . "</label><br></div>
                   <div class='assign-space'><p>Assignment Weightage: </p><label for='question-" . $row['AssignmentID'] . "' class='assign-text'>" . $row['Assignmentweightage'] . "</label><br></div>
                    <a href='deleteassignment.php?id=" . $row['AssignmentID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt' ></i> Delete Assignment</a></div>";
                    $i++;
                }
            } else {
                echo "<div class='successmsg'><label class='successtext'>Data not found</label><br>
            <label class='successtext'>To Post New Announcements <br><div class='btndiv'><a href='add-notice.php' class='button deletetext'>Click Here!</a></div></label></div>";
            }

            ?>
        </div>


    </section>
</body>

</html>