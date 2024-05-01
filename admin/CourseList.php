<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include('components/adminHeader.php');
include('components/sidebar.php');
include('components/dbconnection.php');
$query = "select * from coursedetails";
$run = mysqli_query($con, $query);
$query2 = "Select subjectdetails.Subjectname, subjectdetails.SubjectID, teacherdetails.Firstname,teacherdetails.Lastname, coursedetails.Coursename
from subjectdetails
join coursedetails on coursedetails.CourseID = subjectdetails.SubjectID
join teacherdetails on teacherdetails.TeacherID = subjectdetails.TeacherID";
$run2 = mysqli_query($con, $query2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
    <title>Course list</title>
</head>

<body>
    <div class="mainpage">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="pagetitle">Course Data</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <label class="form-text text-size">Enter the name of course to access their Details</label>
                                <input type="text" name="searchname" id="errormsg" value="" class="form-control input-text">
                            </div>
                            <div class="btndiv"><button class="btn" name="submit" value="submit">Search Data</button>
                                <button class="btn" name="submit2" value="submit2">Get full list</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $search = $_POST['searchname'];
                            $sql2 = "Select CourseID Coursename from coursedetails where Coursename='$search'";
                            $result2 = mysqli_query($con, $sql2);

                            if (mysqli_num_rows($result2) > 0) { ?>
                                <div class="table-control">
                                    <table border="1" cellspacing="6" cellpadding="6">
                                        <tr class="heading">
                                            <th>Course ID</th>
                                            <th>Coursename</th>
                                            <th>Delete</th>
                                        </tr>

                                <?php
                                $i = 1;
                                while ($result3 = mysqli_fetch_assoc($result2)) {
                                    echo "  
                                 <tr class='data'>  
                                      <td>" . $result3['CourseID'] . "</td>  
                                      <td>" . $result3['Coursename'] . "</td>  
                                      <td><a href='deletecourse.php?id=" . $result3['CourseID'] . "' id='btn' style = ' text-decoration: none;'>Delete</a></td>  
                                 </tr>  
                            ";
                                    $i++;
                                }
                            } else {
                                echo "<div class='btndiv'>No Courses with that name exists!</div>";
                            }
                        }
                                ?>

                                <?php
                                if (isset($_POST['submit2'])) {
                                    $i = 1;
                                    if ($num = mysqli_num_rows($run) > 0) {
                                ?>
                                        <div class="table-control">
                                            <table border="1" cellspacing="6" cellpadding="6">
                                                <tr class="heading">
                                                    <th>Course ID</th>
                                                    <th>Coursename</th>
                                                    <th>Delete</th>
                                                </tr><?php
                                                        while ($result = mysqli_fetch_assoc($run)) {

                                                            echo "  
                          <tr class='data'>  
                               <td>" . $result['CourseID'] . "</td>  
                               <td>" . $result['Coursename'] . "</td>   
                               <td><a href='deletecourse.php?id=" . $result['CourseID'] . "' id='btn' style = ' text-decoration: none;'>Delete</a></td>  
                          </tr>  
                     ";
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo "<div class='btndiv'>No courses allocated</div>";
                                                    }
                                                        ?>
                                            </table>
                                        </div>
                                    <?php } ?>

                                </div>
                    </div>
                </div>
                <div class="page-header">
                    <h3 class="pagetitle">Subject Data</h3>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="cardbody">
                            <form action="" method="POST" class="formsample">
                                <div class="form-group">
                                    <label class="form-text text-size">Enter the name of subject to access their Details</label>
                                    <input type="text" name="searchname2" id="errormsg" value="" class="form-control input-text">
                                </div>
                                <div class="btndiv"><button class="btn" name="submit3" value="submit">Search Data</button>
                                    <button class="btn" name="submit4" value="submit">Get full list</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['submit3'])) {
                                $search = $_POST['searchname2'];
                                $sql2 = "Select subjectdetails.Subjectname, subjectdetails.SubjectID, teacherdetails.Firstname,teacherdetails.Lastname, coursedetails.Coursename
                            from subjectdetails
                            join coursedetails on coursedetails.CourseID = subjectdetails.SubjectID
                            join teacherdetails on teacherdetails.TeacherID = subjectdetails.TeacherID
                            where Subjectname = '$search'";
                                $result3 = mysqli_query($con, $sql2);
                                if (mysqli_num_rows($result3) > 0) { ?>
                                    <div class="table-control">
                                        <table border="1" cellspacing="6" cellpadding="6">
                                            <tr class="heading">
                                                <th>Subject ID</th>
                                                <th>Course name</th>
                                                <th>Teacher name</th>
                                                <th>Subjectname</th>
                                                <th>Delete</th>
                                            </tr>

                                    <?php
                                    $i = 1;
                                    while ($result4 = mysqli_fetch_assoc($result3)) {
                                        echo "  
                                 <tr class='data'>  
                                      <td>" . $result4['SubjectID'] . "</td>  
                                      <td>" . $result4['Coursename'] . "</td>  
                                      <td>" . $result4['Firstname'] . " " . $result4['Lastname'] . "</td>  
                                      <td>" . $result4['Subjectname'] . "</td>
                                      <td><a href='deletesubject.php?id=" . $result4['SubjectID'] . "' id='btn' style = ' text-decoration: none;'>Delete</a></td>  
                                 </tr>  
                            ";
                                        $i++;
                                    }
                                } else {
                                    echo "<div class='btndiv'>No subject with that name exists!</div>";
                                }
                            }
                                    ?>

                                    <?php
                                    if (isset($_POST['submit4'])) {
                                        $i = 1;
                                        if ($num = mysqli_num_rows($run2) > 0) {
                                    ?>
                                            <div class="table-control">
                                                <table border="1" cellspacing="6" cellpadding="6">
                                                    <tr class="heading">
                                                        <th>Subject ID</th>
                                                        <th>Course name</th>
                                                        <th>Teacher name</th>
                                                        <th>Subjectname</th>
                                                        <th>Delete</th>
                                                    </tr><?php
                                                            while ($result5 = mysqli_fetch_assoc($run2)) {

                                                                echo "  
                          <tr class='data'>  
                               <td>" . $result5['SubjectID'] . "</td>  
                               <td>" . $result5['Coursename'] . "</td>  
                               <td>" . $result5['Firstname'] . " " . $result5['Lastname'] . "</td>   
                               <td>" . $result5['Subjectname'] . "</td> 
                               <td><a href='deletesubject.php?id=" . $result5['SubjectID'] . "' id='btn' style = ' text-decoration: none;'>Delete</a></td>  
                          </tr>  
                     ";
                                                                $i++;
                                                            }
                                                        } else {
                                                            echo "<div class='btndiv'>No Subjects allocated!</div>";
                                                        }
                                                            ?>
                                                </table>
                                            </div>
                                        <?php }
                                        ?>

                                    </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>