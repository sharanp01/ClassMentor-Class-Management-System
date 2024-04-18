<?php
include('components/dbconnection.php');
include('components/adminHeader.php');
include('components/sidebar.php'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
    <title>Course Details</title>
</head>

<body>
    <div class="mainpage">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="pagetitle">Add Course</h3>
            </div>
            <div class="row">
                <div class="card">
                    <div class="cardbody">
                        <form action="" method="POST" class="formsample">
                            <div class="form-group">
                                <label class="form-text">Course Name</label>
                                <input type="text" name="coursename" id="errormsg" value="" class="form-control" required='true'>
                                <div class="errormsgcss"><span id="errorf" class="errormsg"></span></div>
                            </div>
                            <div class="btndiv"><button class="btn" name="submit" value="submit">Add Course</button>
                            </div>
                            <?php
                            if (isset($_POST['submit'])) {
                                function sanitizeInput($data)
                                {
                                    return htmlspecialchars(strip_tags($data));
                                }

                                // Retrieve data from the form
                                $coursename = mysqli_real_escape_string($con, $_POST["coursename"]);
                                $sqlcheck = "Select * from coursedetails where Coursename = '$coursename'";
                                $rescheck = mysqli_query($con, $sqlcheck);
                                if (mysqli_num_rows($rescheck) <= 0) {
                                    // SQL query to insert data into the database
                                    $sql = "INSERT INTO coursedetails (Coursename)
        VALUES ('$coursename')";

                                    // Execute the query
                                    if ($con->query($sql) === TRUE) {
                                        echo "<div class='btndiv'><label class='form-text'>Data Inserted successfully</label></div>";
                                    } else {
                                    }
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
    <script src="admin.js">

    </script>
</body>


</html>