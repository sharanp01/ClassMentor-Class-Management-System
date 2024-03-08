<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questions</title>
  <link rel="stylesheet" href="styles/sidebarstyle.css">
  <link rel="stylesheet" href="styles/tablestyle.css">
  <link rel="stylesheet" href="styles/resstyle.css">
</head>
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
  }

  .option-text {
    border: 2px solid black;
    width: 20%;
    padding: 5px;
    margin-bottom: 10px;
    border-radius: 10px;
  }

  .question-details a {
    margin-top: 10px;
  }

  .question-checkbox:checked~.question-details {
    max-height: 500px;
  }

  .btndiv a {
    color: white;
    text-decoration: none;
  }

  .btndiv a:hover {
    color: black;
  }
</style>

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

  <div class="resource-control">
    <h1 class="heading-text">Test/<?php if (isset($_GET['questionid'])) {
                                    include("components/connect.php");
                                    $id2 = $_GET['questionid'];
                                    $namesql = "Select Quiztopic from quiztopic where QuizID = '$id2'";
                                    $res = mysqli_query($conn, $namesql);
                                    $namerow = mysqli_fetch_assoc($res);
                                    echo  $namerow['Quiztopic'];
                                  }
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
            echo "<div class='option-text'><p>Option 1 : " . $row['Option1'] . "</p></div>";
            echo "<div class='option-text'><p>Option 2 : " . $row['Option2'] . "</p></div>";
            echo "<div class='option-text'><p>Option 3 : " . $row['Option3'] . "</p></div>";
            echo "<div class='option-text'><p>Option 4 : " . $row['Option4'] . "</p></div>";
            echo "<div class='option-text'><p>Answer : " . $row['Answer'] . "</p></div>";
            echo "<a href='deletequestions.php?id=" . $row['QuestionID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt' ></i> Delete Question</a>";
            echo "</div>";
            $i++;
          }
        } else {
          echo "No questions found";
        }
      }
      ?>
      <div class="centerdiv btndiv">
        <button class="button"><a href="displaytest.php">Back to Display page</a></button>
      </div>
    </div>
  </div>



</body>

</html>