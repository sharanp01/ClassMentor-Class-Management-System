<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include("components/dbconnection.php");
include("components/adminHeader.php");
include("components/sidebar.php");
$sql = "SELECT COUNT(*) AS total_rows FROM studentdetails";
$sql2 = "SELECT COUNT(*) AS total_rows FROM teacherdetails";
$sql3 = "SELECT COUNT(*) AS total_rows FROM coursedetails";
$res1 = mysqli_query($con, $sql);
$res2 = mysqli_query($con, $sql2);
$res3 = mysqli_query($con, $sql3);
if ($res1) {
    $row = $res1->fetch_assoc();
    $total_rows = $row['total_rows'];
}
if ($res2) {
    $row = $res2->fetch_assoc();
    $total_rows2 = $row['total_rows'];
}
if ($res3) {
    $row = $res3->fetch_assoc();
    $total_rows3 = $row['total_rows'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
    <link rel="stylesheet" type="text/css" href="style/admindashboardstyle.css" />
    <title>Document</title>
</head>

<body>
    <div class="mainpage">
        <div class="headertext">
            <img src="images/dashboard.png" alt="" class="dashimage">
            <label for="" class="dashtext">Dashboard</label>
        </div>
        <div class="stat">
            <div class="studstat">
                <label for="" class="count">Number of Students:</label><br>
                <label for="" class="statcount count"><?php echo $total_rows; ?></label>
            </div>
            <div class="teachstat">
                <label for="" class="count">Number of Teachers:</label><br>
                <label for="" class="statcount count"><?php echo $total_rows2; ?></label>
            </div>

            <div class="coursestat">
                <label for="" class="count">Number of Courses:</label><br>
                <label for="" class="statcount count"><?php echo $total_rows3; ?></label>
            </div>
        </div>
    </div>
</body>

</html>