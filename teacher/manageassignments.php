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
                    <a href="logout.php"><button class="Btn">
                            <div class="sign"><svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg></div>
                            <div class="text">Logout</div>
                        </button>
                    </a>
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
                   <a href='assignmarks.php?id=" . $row['AssignmentID'] . "' id='btn' class='deletetext2'>Assign Marks</a>
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