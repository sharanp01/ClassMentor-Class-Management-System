<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include('components/sidebar.php');
include('components/connect.php');
$username = $_SESSION['username'];
$sql = "select * from teacherdetails where Username= '$username' ";
$result = mysqli_query($conn, $sql);
$answer = mysqli_fetch_assoc($result);
$answer2 = $answer['TeacherID'];
$sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
$result2 = mysqli_query($conn, $sql2);
$subjectanswer = mysqli_fetch_assoc($result2);
$subjectanswer2 = $subjectanswer['SubjectID'];
$sql3 = "Select * from quiztopic where SubjectID='$subjectanswer2'";
$result3 = mysqli_query($conn, $sql3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <title>Test</title>
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
        </div>
        <div class="table-control">
            <h1 class="heading-text">Test/Manage Tests</h1>
            <?php
            if (mysqli_num_rows($result3) > 0) {
            ?>

                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Quiz Topic</th>
                        <th>Add Questions</th>
                        <th>View Questions</th>
                        <th>View Results</th>
                        <th>Remove</th>
                    </tr>

                <?php
                $i = 1;
                while ($result4 = mysqli_fetch_assoc($result3)) {

                    echo "  
         <tr class='data'>  
              <td>" . $i . "</td>  
              <td>" . $result4['Quiztopic'] . "</td>
              <td><a href='Addquestions.php?quizid=" . $result4['QuizID'] . "' id='btn' class='deletetext2' >Select</a></td>
              <td><a href='displayquestions.php?questionid=" . $result4['QuizID'] . "' id='btn' class='deletetext2' >View</a></td>
              <td><a href='studentresults.php?id=" . $result4['QuizID'] . "' id='btn' class='deletetext2' >View Results</a></td>
              <td><a href='deletequiz.php?id=" . $result4['QuizID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt'  ></i> Delete</a></td>
         </tr>  
    ";
                    $i++;
                }
            } else {
                echo "<div class='successmsg'><label class='successtext'>Data not found</label><br>
            <label class='successtext'>To Assign New Tests <br><div class='btndiv'><a href='QuizDetails.php' class='button deletetext'>Click Here!</a></div></label></div>";
            }

                ?>
        </div>
    </section>
</body>

</html>