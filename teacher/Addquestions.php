<?php
include('components/sidebar.php');
include('components/connect.php');
if (isset($_GET['quizid'])) {
    $quizID = $_GET['quizid'];
} else {
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
    <title>Add Questions</title>
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
            <h1 class="heading-text">Test/Add Question</h1>
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
                        $sqlcheck = "Select * from quizdetails where Question = '$question' and QuizID = '$quizID'";
                        $rescheck = mysqli_query($conn, $sqlcheck);
                        if (mysqli_num_rows($rescheck) <= 0) {
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
                    }
                    ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>