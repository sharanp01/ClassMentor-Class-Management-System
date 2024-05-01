<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit(); 
}
include("components/connect.php");
include("components/sidebar.php");
$username = $_SESSION['username'];
$sql = "select * from teacherdetails where Username= '$username' ";
$result = mysqli_query($conn, $sql);
$answer = mysqli_fetch_assoc($result);
$answer2 = $answer['TeacherID'];
$sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
$result2 = mysqli_query($conn, $sql2);
$subjectanswer = mysqli_fetch_assoc($result2);
$subjectname = $subjectanswer['Subjectname'];
$subjectanswer2 = $subjectanswer['SubjectID'];
$sql3 = "select CourseID from subjectdetails where SubjectID = '$subjectanswer2'";
$result3 = mysqli_query($conn, $sql3);
$courseanswer = mysqli_fetch_assoc($result3);
$courseanswer2 = $courseanswer['CourseID'];
$sql4 = "select Firstname, Lastname, Email, Phone from studentdetails where CourseID = '$courseanswer2'";
$sql5 = "SELECT COUNT(*) AS total_rows FROM studentdetails where CourseID = '$courseanswer2'";
$result4 = mysqli_query($conn, $sql4);
$result5 = mysqli_query($conn, $sql5);
if ($result5) {
    $row = $result5->fetch_assoc();
    $total_rows2 = $row['total_rows'];
}
$currentDate = date('Y-m-d');
$sql = "SELECT * FROM timetabledetails WHERE Date >= '$currentDate' AND TeacherID='$answer2' ORDER BY Date ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currdate = date('d-m-Y', strtotime($row['Date']));
    $start = date('H:i', strtotime($row['Starttime']));
    $end = date('H:i', strtotime($row['Endtime']));
} else {
    $currdate = "No lectures scheduled yet";
    $start = "No time scheduled";
    $end = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <link rel="stylesheet" href="styles/dashboardstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Dashboard</title>
</head>

<body>
    <section class="home-section">

        <div class="home-content">
            <div class="left-content">
                ClassMentor
            </div>
            <div class="right-content">
                <label for="" class="dropdowntext">Welcome <?php echo $username; ?></label>
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
        <div class="headertext">
            <img src="images/dashboard.png" alt="" class="dashimage">
            <label for="" class="dashtext">Dashboard</label>
        </div>
        <div class="stat">
            <div class="subname">
                <label for="" class="count">Name of your Subject:</label><br>
                <label for="" class="statcount count"><?php echo $subjectname; ?></label>
            </div>
            <div class="studstat">
                <label for="" class="count">Number of Students:</label><br>
                <label for="" class="statcount count"><?php echo $total_rows2; ?></label>
            </div>
            <div class="timestat">
                <label for="" class="count">Next lec scheduled on: <?php echo $currdate; ?> </label><br>
                <label for="" class="statcount count">Start Time: <?php echo $start; ?></label><br>
                <label for="" class="statcount count">Endtime Time: <?php echo $end; ?></label>
            </div>
        </div>

        <?php
        if ($result4) {
            if (mysqli_num_rows($result4) > 0) { ?>
                <div class="table-control">

                    <label for="" class="dashtext">Students under your subject</label>

                    <table border="1" cellspacing="6" cellpadding="6">
                        <tr class="heading">
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Phone</th>

                        </tr>

                <?php
                $i = 1;
                while ($result5 = mysqli_fetch_assoc($result4)) {
                    echo "  
             <tr class='data'>  
                 
                  <td>" . $result5['Firstname'] . "</td>  
                  <td>" . $result5['Lastname'] . "</td>  
                  <td>" . $result5['Email'] . "</td>  
                  <td>" . $result5['Phone'] . "</td>  
     
             </tr>  
                 
        ";
                    $i++;
                }
            } else {
                echo "<div class='btndiv'>Data not found</div>";
            }
        }
                ?>
    </section>
</body>

</html>