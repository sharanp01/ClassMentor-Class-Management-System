<?php

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
    <style>
        .question-checkbox {
            display: none;
        }


        .question-label {
            cursor: pointer;
            font-weight: bold;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            display: inline-block;
            align-items: center;

            justify-content: space-between;

            transition: background-color 0.3s ease;

        }

        .question-label p {
            display: inline-block;
            margin-right: 5px;
        }


        .question-label:hover {
            background-color: #f0f0f0;
        }


        .question-details {
            max-height: 0;
            padding-top: 10px;
            overflow: hidden;
            padding-left: 10px;
            transition: max-height 0.6s ease;

            background-color: yellow;

        }

        .question-details p {
            margin-top: 10px;
        }

        .question-details a {
            margin-top: 10px;
        }


        .question-checkbox:checked~.question-details {

            max-height: 500px;

        }
    </style>
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

    <div class="resource-control">
        <h1 class="heading-text">Test/<?php if(isset($_GET['questionid'])){
            include("components/connect.php");
            $id2 = $_GET['questionid'];
            $namesql = "Select Quiztopic from quiztopic where QuizID = '$id2'";
            $res = mysqli_query($conn,$namesql);
            $namerow = mysqli_fetch_assoc($res);
            echo  $namerow['Quiztopic'];}
        ?> Questions</h1>
        <div class="questions-container">
            <?php

            include("components/connect.php");
            if (isset($_GET['questionid'])) {
                $id = $_GET['questionid'];
                $sql = "Select * from quizdetails where QuizID='$id'";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<input type='checkbox' id='question-" . $row['QuestionID'] . "' class='question-checkbox'>";
                        echo "<div  class='question-label'><p>Q." . $i . ")</p><label for='question-" . $row['QuestionID'] . "'>" . $row['Question'] . "</label></div>";
                        echo "<div class='question-details'>";
                        echo "<p>Option 1: " . $row['Option1'] . "</p>";
                        echo "<p>Option 2: " . $row['Option2'] . "</p>";
                        echo "<p>Option 3: " . $row['Option3'] . "</p>";
                        echo "<p>Option 4: " . $row['Option4'] . "</p>";
                        echo "<p>Answer: " . $row['Answer'] . "</p>";
                        echo "<a href='deleteassignment.php?id=" . $row['QuestionID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt'  ></i> Delete</a>";
                        echo "</div>";
                        $i++;
                    }
                } else {
                    echo "No questions found";
                }
            }
            ?>
        </div>
    </div>



</body>

</html>