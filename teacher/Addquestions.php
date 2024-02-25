<?php
include('components/sidebar.php');
include('components/connect.php');
if (isset($_GET['quizid'])) {

    $quizID = $_GET['quizid'];
    echo "QuizID: " . $quizID;
} else {
    echo "QuizID not found in the URL";
}
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
        <div class="resource-control">
            <div class="left-content">
                <h1 class="heading-text">Test/Add Question</h1>
            </div>
            <form action="" method="post">
                <div class="resinput">
                    <label for="">Enter Question:</label><br>
                    <textarea name="question" id="" cols="60" rows="3" required></textarea><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 1:</label><br>
                    <input type="text" name="option1" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 2:</label><br>
                    <input type="text" name="option2" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 3:</label><br>
                    <input type="text" name="option3" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 4:</label><br>
                    <input type="text" name="option4" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Answer:</label><br>
                    <input type="text" name="answer" id="resname" class="resname" required><br>
                </div>
                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button">Add Question</button>

                    <?php
                    if (isset($_POST['submit'])) {
                        $question = $_POST['question'];
                        $opt1 = $_POST['option1'];
                        $opt2 = $_POST['option2'];
                        $opt3 = $_POST['option3'];
                        $opt4 = $_POST['option4'];
                        $answer = $_POST['answer'];
                        $sql = "Insert into quizdetails (QuizID, Question, Option1,Option2,Option3,Option4,Answer) values('$quizID','$question','$opt1','$opt2','$opt3','$opt4','$answer')";
                        if ($conn->query($sql) == TRUE) {
                            echo "<div class='successmsg'>
                    <label class='successtext'>Question Added!</label>
        </div>";
                        } else {
                            echo "<div class='successmsg'>
                    <label class='successtext'>Question Was'nt Added!</label>
        </div>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>