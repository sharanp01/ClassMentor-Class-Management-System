<?php
include('components/connect.php');
include('components/sidebar.php');
$username = "sathya05";
$studentsql = "select CourseID from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];
$sql = "SELECT subjectdetails.Subjectname, teacherdetails.Firstname, assignmentdetails.Assignmentquestion, assignmentdetails.AssignmentSubdate, assignmentdetails.Assignmentweightage, assignmentdetails.AssignmentSublink
FROM assignmentdetails
INNER JOIN subjectdetails ON subjectdetails.SubjectID = assignmentdetails.SubjectID
INNER JOIN teacherdetails ON teacherdetails.TeacherID = assignmentdetails.TeacherID
WHERE assignmentdetails.CourseID = '$col1'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .announcement-label {
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

        /* .announcement-label */
        .announcement-heading {
            font-size: 1.3rem;
            text-align: center;
        }
        .announcement-heading hr{
            border: 2px solid black;
            margin: 12px 10px 10px 10px;
        }
        .announce-space {
            margin-bottom: 10px;
        }

        .announcement-label p {
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
        }

      
       
        .announce-button hr{
            border: 2px solid black;
            margin: 12px 10px 5px 10px;
        }

        .announce-desc {
            font-size: 1rem;
            margin-left: 15px;
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
            <h1 class="heading-text">Assignments</h1>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<div  class='announcement-label'><div class='announcement-heading'>New Assignment<hr></div>
            <div class='announce-desc'><p>Assignment Question: </p><label  class='assign-text'>" . $row['Assignmentquestion'] . "</label><br></div>
            <div class='announce-desc'><p>Assignment Submission Date: </p><label  class='assign-text'>" . $row['AssignmentSubdate'] . "</label><br></div>
            <div class='announce-desc'><p>Assignment Weightage: </p><label  class='assign-text'>" . $row['Assignmentweightage'] . " marks</label><br></div>
            <div class='announce-desc'><p>From Subject: </p><label  class='assign-text'>" . $row['Subjectname'] . "</label><br></div>
            <div class='announce-desc'><p>Assignment By: </p><label  class='assign-text'>" . $row['Firstname'] . "</label><br></div>
           <div class='announce-button'><div class='btndiv centerdiv'><a href ='" . $row['AssignmentSublink'] . "'><button class='button'>Go to Submission Link</button></a></div></div></div>";
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