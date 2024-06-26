<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include('components/connect.php');
include("components/sidebar.php");
$username = $_SESSION['username'];
$studentsql = "select * from studentdetails where Username = '" . $username . "' ";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col2 = $row1['StudentID'];
$assignmentsql = "SELECT assignmentdetails.Assignmentquestion, assignmentdetails.Assignmentweightage, assignmentmarks.Marks
FROM assignmentmarks 
INNER JOIN assignmentdetails ON assignmentdetails.AssignmentID = assignmentmarks.AssignmentID
WHERE StudentID = '$col2'";
$assignmentresult = mysqli_query($conn, $assignmentsql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <title>Assignment Marks</title>
</head>

<body>
    <section class="home-section">
        <div class="home-content">
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
            <h1>Assignment Marks</h1>
            <?php
            if (mysqli_num_rows($assignmentresult) > 0) {
            ?>

                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Assignment Question</th>
                        <th>Assignment Weightage</th>
                        <th>Your Marks</th>
                    </tr>

                <?php
                $i = 1;
                while ($result3 = mysqli_fetch_assoc($assignmentresult)) {

                    echo "  
         <tr class='data'>  
              <td>" . $i . "</td>  
              <td>" . $result3['Assignmentquestion'] . "</td>
              <td>" . $result3['Assignmentweightage'] . "</td>
              <td>" . $result3['Marks'] . "</td>   
         </tr>";
                    $i++;
                }
            } else {
                echo "<div class='successmsg'><label class='successtext'>Marks Not Assigned for the assignment!Check Later</label><br></div>";
            }

                ?>
        </div>
</body>

</html>