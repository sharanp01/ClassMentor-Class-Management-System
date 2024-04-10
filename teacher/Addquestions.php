<?php
include('components/sidebar.php');
include('components/connect.php');
if (isset($_GET['quizid'])) {
    $quizID = $_GET['quizid'];
} else {
}
$errors = [];
function sanitizeInput($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question = sanitizeInput($_POST['question']);
    if (strlen($question) > 200) {
        $errors['question'] = "Question must be 200 characters or less";
    }

    $option1 = sanitizeInput($_POST['option1']);
    if (strlen($option1) > 70) {
        $errors['option1'] = "Option1 must be 70 characters or less";
    }
    $option2 = sanitizeInput($_POST['option2']);
    if (strlen($option2) > 70) {
        $errors['option2'] = "Option2 must be 70 characters or less";
    }
    $option3 = sanitizeInput($_POST['option3']);
    if (strlen($option3) > 70) {
        $errors['option3'] = "Option3 must be 70 characters or less";
    }
    $option4 = sanitizeInput($_POST['option4']);
    if (strlen($option4) > 70) {
        $errors['option4'] = "Option4 must be 70 characters or less";
    }
    $answer = sanitizeInput($_POST['answer']);
    if (strlen($answer) > 70) {
        $errors['answer'] = "Answer must be 70 characters or less";
    }
    if($option1!= $answer && $option2!= $answer && $option3!= $answer && $option4!= $answer)
    {
        $errors['matching'] = "Answer must match with one of the options";
    }
    if (empty($errors)) {
        $question = mysqli_real_escape_string($conn ,  $_POST['question']);
        $opt1 =mysqli_real_escape_string($conn ,  $_POST['option1']);
        $opt2 =mysqli_real_escape_string($conn ,  $_POST['option2']);
        $opt3 = mysqli_real_escape_string($conn ,  $_POST['option3']);
        $opt4 = mysqli_real_escape_string($conn ,  $_POST['option4']);
        $answer = mysqli_real_escape_string($conn ,  $_POST['answer']);
        $sqlcheck = "Select * from quizdetails where Question = '$question' and QuizID = '$quizID'";
        $rescheck = mysqli_query($conn, $sqlcheck);
        if (mysqli_num_rows($rescheck) <= 0) {
            $sql = "Insert into quizdetails (QuizID, Question, Option1,Option2,Option3,Option4,Answer) values('$quizID','$question','$opt1','$opt2','$opt3','$opt4','$answer')";
            if ($conn->query($sql) == TRUE) {
                $errors['question-insertion'] = "<div class='successmsg'>
    <label class='successtext'>Question Added!</label>
</div>";
            } else {
                $errors['question-insertion'] = "<div class='successmsg'>
    <label class='successtext'>Question Was'nt Added!</label>
</div>";
            }
        }
    }
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
                    <textarea name="question" value="<?= isset($_POST['question']) ? htmlspecialchars($_POST['question']) : ''; ?> " id="" cols="60" rows="3" placeholder="Character limit: 200 Words"></textarea><br>
                    <?php if (isset($errors['question'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['question']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 1:</label><br>
                    <input type="text" name="option1" value="<?= isset($_POST['option1']) ? htmlspecialchars($_POST['option1']) : ''; ?> " id="resname" class="resname" placeholder="Character limit: 70 " required><br>
                    <?php if (isset($errors['option1'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['option1']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 2:</label><br>
                    <input type="text" name="option2" value="<?= isset($_POST['option2']) ? htmlspecialchars($_POST['option2']) : ''; ?> " id="resname" class="resname" placeholder="Character limit: 70 " required><br>
                    <?php if (isset($errors['option2'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['option2']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 3:</label><br>
                    <input type="text" name="option3" value="<?= isset($_POST['option3']) ? htmlspecialchars($_POST['option3']) : ''; ?> " id="resname" class="resname" placeholder="Character limit: 70 " required><br>
                    <?php if (isset($errors['option3'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['option3']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Option 4:</label><br>
                    <input type="text" name="option4" value="<?= isset($_POST['option4']) ? htmlspecialchars($_POST['option4']) : ''; ?> " id="resname" class="resname" placeholder="Character limit: 70 " required><br>
                    <?php if (isset($errors['option4'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['option4']}</span></div>"; ?>
                </div>
                <div class="resinput">
                    <label for="">Enter Answer:</label><br>
                    <input type="text" name="answer" value="<?= isset($_POST['answer']) ? htmlspecialchars($_POST['answer']) : ''; ?> " id="resname" class="resname" placeholder="Character limit: 70 " required><br>
                    <?php if (isset($errors['answer'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['answer']}</span></div>"; ?>
                    <?php if (isset($errors['matching'])) echo "<div class='errormsgcss'><span class='errormsg' style='color:red;'>{$errors['matching']}</span></div>"; ?>
                </div>
                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button">Add Question</button>
                    <?php if (isset($errors['question-insertion'])) echo "{$errors['question-insertion']}"; ?>
                </div>
            </form>
        </div>
    </section>
</body>

</html>