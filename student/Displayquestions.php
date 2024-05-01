<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <title>Quiz Page</title>
    <style>
        .question {
            margin-bottom: 30px;
        }
    </style>
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
                    </div>
                </div>
            </div>
        </div>
        </div>
    <div class="resource-control">
        <h1>Test/<?php if (isset($_GET['id'])) {
                        include("components/connect.php");
                        $id = $_GET['id'];
                        $namesql = "Select Quiztopic from quiztopic where QuizID = '$id'";
                        $res = mysqli_query($conn, $namesql);
                        $namerow = mysqli_fetch_assoc($res);
                        echo  $namerow['Quiztopic'];
                    }
                    ?> Questions</h1>
        </h1>
        <?php
        include("components/connect.php");
        /* echo "You're in the questions page"; */
        if (isset($_GET['studid'])) {
            $studid = $_GET['studid'];
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $check = "Select * from quizmarks where QuizID='$id' AND StudentID='$studid'";
                $checkresult = mysqli_query($conn, $check);
                if (mysqli_num_rows($checkresult) <= 0) {
                    $sql = "SELECT * FROM quizdetails where QuizID='$id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<form id='quizForm' action='Result.php?id=$id&studid=$studid' method='POST'>";
                        echo "<table border='0' cellspacing='5' cellpadding='6'>";
                        $qno = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $qno . ")</td>";
                            echo "<td>" . $row['Question'] . " ?</td></tr>";
                            $op1 = $row['Option1'];
                            $op2 = $row['Option2'];
                            $op3 = $row['Option3'];
                            $op4 = $row['Option4'];
                            echo "<tr><td><input type='radio' name='" . $qno . "' value='" . $op1 . "'style='vertical-align:middle;'></td><td>" . $op1 . "</td></tr>";
                            echo "<tr><td><input type='radio' name='" . $qno . "' value='" . $op2 . "'style='vertical-align:middle;'></td><td>" . $op2 . "</td></tr>";
                            echo "<tr><td><input type='radio' name='" . $qno . "' value='" . $op3 . "'style='vertical-align:middle;'></td><td>" . $op3 . "</td></tr>";
                            echo "<tr><td><input type='radio' name='" . $qno . "' value='" . $op4 . "'style='vertical-align:middle;'></td><td>" . $op4 . "</td></tr>";
                            $qno++;
                        }
                        echo "</table>";
                        echo "<div class='centerdiv btndiv'>";
                        echo "<input type='reset' class='button' style='margin-right: 20px; width: 120px;'>";
                        echo "<input type='submit' name='submit' value='ViewScore' class='button'></div>";
                        echo "</form>";
                    } else {
                        echo "0 results";
                    }
                } else {
                    echo "<div class='successmsg centerdiv'><label class='successtext'>Test Attempted</label><br>
                    <label class='successtext'>To View the test Results <br><div class='btndiv'><a href='Showresult.php?id=$id&studid=$studid' class='button deletetext'>Click Here!</a></div></label></div>";
                }
            }
        }
        ?>
    </div>
</body>

</html>