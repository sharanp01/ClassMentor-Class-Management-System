<?php
include('components/connect.php');
include('components/sidebar.php');
$username = "sathya05";
$studentsql = "select CourseID,StudentID from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];
$col2 = $row1['StudentID'];
$sql3 = "Select * from quiztopic where CourseID='$col1'";
$result3 = mysqli_query($conn, $sql3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentstyle.css">
    
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
            <h1 class="heading-text">Test/Give Tests</h1>
            <?php
            if (mysqli_num_rows($result3) > 0) {
            ?>

                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Quiz Topic</th>
                        <th>Diffculty</th>
                        <th>Give Test</th>
                        <th>View Test Results</th>
                    </tr>

                <?php
                $i = 1;
                while ($result4 = mysqli_fetch_assoc($result3)) {

                    echo "  
         <tr class='data'>  
              <td>" . $i . "</td>  
              <td>" . $result4['Quiztopic'] . "</td>
              <td>" . $result4['Difficulty'] . "</td>
              <td><a href='Displayquestions.php?id=" . $result4['QuizID'] . "&studid=".$col2."' id='btn' class='deletetext2' >Select</a></td>
              <td><a href='Showresult.php?id=" . $result4['QuizID'] . "&studid=".$col2."' id='btn' class='deletetext2' >View</a></td>
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