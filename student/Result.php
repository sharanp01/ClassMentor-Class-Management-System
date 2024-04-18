<?php
include("components/connect.php");
if (isset($_GET['studid'])) {
    $studid = $_GET['studid'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM quizdetails where QuizID='$id'";
        $result = $conn->query($sql);

        $score = 0;
        $attempted = 0;
        $totalQuestions = 0;
        $wrongquestions = 0;
        $sql1 = "SELECT COUNT(*) AS total_rows FROM quizdetails where QuizID = '$id'";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1) {
            $row = $res1->fetch_assoc();
            $notattempted = $row['total_rows'];
        }
        for ($qno = 1; $row = $result->fetch_assoc(); $qno++) {
            $totalQuestions++;
            $cans = $row['Answer'];
            if (isset($_POST[$qno])) {
                $uans = $_POST[$qno];
                $attempted++;
                $notattempted--;
                if ($cans == $uans) {
                    $score++;
                } else {
                    $wrongquestions++;
                }
            } else {
            }
        }
        $check = "Select * from quizmarks where QuizID='$id' AND StudentID='$studid'";
        $checkresult = mysqli_query($conn, $check);

        if (mysqli_num_rows($checkresult) <= 0) {
            $sql = "INSERT into quizmarks(QuizID,StudentID,Attempted,Notattempted,Wrongans,Totalmarks) VALUES ('$id','$studid','$attempted','$notattempted','$wrongquestions','$score')";
            $result = mysqli_query($conn, $sql);
        }

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="styles/studentstyle.css">
            <title>Results</title>
        </head>

        <body>
            <div class="home-content" style="background-color: black;">
                <div class="left-content">
                    ClassMentor
                </div>
                <div class="right-content">

                    <div class="dropdown">
                        <div class="dropdown">
                            <a href="logout.php"><button class="Btn">
                                    <div class="sign"><svg viewBox="0 0 512 512">
                                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                        </svg></div>
                                    <div class="text">Logout</div>
                                </button>
                            </a>
                        </div>s
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
                                            ?> Test/ Results</h1>
                <?php
                $quescount = "SELECT COUNT(*) AS total_rows FROM quizdetails where QuizID = '$id'";
                $quesresult = mysqli_query($conn, $quescount);
                $qures = mysqli_query($conn, $sql1);
                if ($qures) {
                    $row = $quesresult->fetch_assoc();
                    $totalQuestions = $row['total_rows'];
                    if (mysqli_num_rows($quesresult) > 0) {
                ?>

                        <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                            <tr class="heading">
                                <th>Total Questions</th>
                                <th>No of Attempted Questions</th>
                                <th>No of Unattempted Questions</th>
                                <th>No of Wrong Answers</th>
                                <th>Total Score</th>
                            </tr>

            <?php
                        echo "  
         <tr class='data'>  
              <td>" . $totalQuestions . "</td>
              <td>" . $attempted . "</td>
              <td>" . $notattempted . "</td>
              <td>" . $wrongquestions . "</td>
              <td>" . $score . "</td>
         </tr>  
    ";
                    }
                } else {
                    echo "<div class='successmsg'><label class='successtext'>Data not found</label><br>";
                }
            }
        }


            ?>
            
    </div>
        </body>

        </html>