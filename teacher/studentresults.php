<?php
include("components/connect.php");
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
        <h1 class="heading-text"><?php if (isset($_GET['id'])) {
                                        include("components/connect.php");
                                        $id = $_GET['id'];
                                        $namesql = "Select Quiztopic from quiztopic where QuizID = '$id'";
                                        $res = mysqli_query($conn, $namesql);
                                        $namerow = mysqli_fetch_assoc($res);
                                        echo  $namerow['Quiztopic'];
                                    }
                                    ?> Test/View Results</h1>
        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT studentdetails.Firstname, studentdetails.Lastname, quizmarks.Attempted, quizmarks.NotAttempted, quizmarks.Wrongans, quizmarks.Totalmarks FROM quizmarks
                INNER JOIN studentdetails ON studentdetails.StudentID = quizmarks.StudentID
                 WHERE QuizID = '$id'";
                $result = mysqli_query($conn, $sql);
                $quescount = "SELECT COUNT(*) AS total_rows FROM quizdetails where QuizID = '$id'";
                $quesresult = mysqli_query($conn, $quescount);
                if ($quesresult) {
                    $row = $quesresult->fetch_assoc();
                    $totalQuestions = $row['total_rows'];
                    if (mysqli_num_rows($result) > 0) {
        ?>

                        <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                            <tr class="heading">
                                <th>Sr No</th>
                                <th>First</th>
                                <th>Lastname</th>
                                <th>Total Questions</th>
                                <th>No of Attempted Questions</th>
                                <th>No of Unattempted Questions</th>
                                <th>No of Wrong Answers</th>
                                <th>Total Score</th>
                            </tr>

            <?php
                        $i = 1;
                        while ($result4 = mysqli_fetch_assoc($result)) {

                            echo "  
                         <tr class='data'>  
                              <td>" . $i . "</td>
                              <td>" . $result4['Firstname'] . "</td>
                              <td>" . $result4['Lastname'] . "</td>
                              <td>" . $totalQuestions . "</td>
                              <td>" . $result4['Attempted'] . "</td>
                              <td>" . $result4['NotAttempted'] . "</td>
                              <td>" . $result4['Wrongans'] . "</td>
                              <td>" . $result4['Totalmarks'] . "</td>
                         </tr>  
                    ";
                            $i++;
                        }
                    } else {
                        echo "<div class='successmsg'><label class='successtext'>Test not attempted Yet</label><br>
                            <label class='successtext'>To Attempt the test <br><div class='btndiv'><a href='studentquizdisplay.php' class='button deletetext'>Click Here!</a></div></label></div>";
                    }
                }
            }
    

            ?>
    </div>

</body>

</html>