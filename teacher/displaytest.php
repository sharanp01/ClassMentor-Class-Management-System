<?php
include('components/sidebar.php');
include('components/connect.php');
$username = "Divya01";
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
    <title>Document</title>
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