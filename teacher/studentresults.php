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
    <title>Results</title>
</head>

<body>
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