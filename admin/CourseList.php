<?php
include('components/adminHeader.php');
include('components/sidebar.php');
include('components/dbconnection.php');
$query = "select * from coursedetails";
$run = mysqli_query($con, $query);

$query2 = "select * from subjectdetails";
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
                            $sql2 = "Select CourseID Coursename from coursedetails where Course name='$search'";
                            $result2 = mysqli_query($con, $sql2);
                            if ($result2) {
                                if (mysqli_num_rows($result2) > 0) { ?>
                                    <div class="table-control">
                                        <table border="1" cellspacing="6" cellpadding="6">
                                            <tr class="heading">
                                                <th>Course ID</th>
                                                <th>Coursename</th>
                                            </tr>

                                <?php
                                    $i = 1;
                                    while ($result3 = mysqli_fetch_assoc($result2)) {
                                        echo "  
                                 <tr class='data'>  
                                      <td>" . $result3['CourseID'] . "</td>  
                                      <td>" . $result3['Coursename'] . "</td>  
                                      <td><a href='deletecourse.php?id=" . $result3['CourseID'] . "' id='btn'>Delete</a></td>  
                                 </tr>  
                            ";
                                        $i++;
                                    }
                                } else {
                                    echo "Data not found";
                                }
                            }
                        } ?>

                                <?php
                                if (isset($_POST['submit2'])) { ?>
                                    <div class="table-control">
                                        <table border="1" cellspacing="6" cellpadding="6">
                                            <tr class="heading">
                                                <th>Course ID</th>
                                                <th>Coursename</th>
                                            </tr> <?php
                                                    $i = 1;
                                                    if ($num = mysqli_num_rows($run) > 0) {
                                                        while ($result = mysqli_fetch_assoc($run)) {

                                                            echo "  
                          <tr class='data'>  
                               <td>" . $result['CourseID'] . "</td>  
                               <td>" . $result['Coursename'] . "</td>   
                               <td><a href='deletecourse.php?id=" . $result['CourseID'] . "' id='btn'>Delete</a></td>  
                          </tr>  
                     ";
                                                            $i++;
                                                        }
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
                            $sql2 = "Select SubjectID, CourseID, TeacherID, Subjectname from subjectdetails where Subjectname ='$search'";
                            $result3 = mysqli_query($con, $sql2);
                            if ($result3) {
                                if (mysqli_num_rows($result3) > 0) { ?>
                                    <div class="table-control">
                                        <table border="1" cellspacing="6" cellpadding="6">
                                            <tr class="heading">
                                                <th>Subject ID</th>
                                                <th>Course ID</th>
                                                <th>Teacher ID</th>
                                                <th>Subjectname</th>
                                            </tr>

                                <?php
                                    $i = 1;
                                    while ($result4 = mysqli_fetch_assoc($result3)) {
                                        echo "  
                                 <tr class='data'>  
                                      <td>" . $result4['SubjectID'] . "</td>  
                                      <td>" . $result4['CourseID'] . "</td>  
                                      <td>" . $result4['TeacherID'] . "</td>  
                                      <td>" . $result4['Subjectname'] . "</td>
                                      <td><a href='deletesubject.php?id=" . $result4['SubjectID'] . "' id='btn'>Delete</a></td>  
                                 </tr>  
                            ";
                                        $i++;
                                    }
                                } else {
                                    echo "Data not found";
                                }
                            }
                        } ?>

                                <?php
                                if (isset($_POST['submit4'])) { ?>
                                    <div class="table-control">
                                        <table border="1" cellspacing="6" cellpadding="6">
                                            <tr class="heading">
                                                <th>Subject ID</th>
                                                <th>Course ID</th>
                                                <th>Teacher ID</th>
                                                <th>Subjectname</th>
                                            </tr> <?php
                                                    $i = 1;
                                                    if ($num = mysqli_num_rows($run2) > 0) {
                                                        while ($result5 = mysqli_fetch_assoc($run2)) {

                                                            echo "  
                          <tr class='data'>  
                               <td>" . $result5['SubjectID'] . "</td>  
                               <td>" . $result5['CourseID'] . "</td>   
                               <td>" . $result5['TeacherID'] . "</td>  
                               <td>" . $result5['Subjectname'] . "</td> 
                               <td><a href='deletesubject.php?id=" . $result5['SubjectID'] . "' id='btn'>Delete</a></td>  
                          </tr>  
                     ";
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                        </table>
                                    </div>
                                <?php } ?>

                                    </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>