<?php
include('components/dbconnection.php');
include('components/sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
  <title>Student details</title>
</head>

<body>
  <div class="mainpage">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="pagetitle">Add Student</h3>
      </div>
      <div class="row">
        <div class="card">
          <div class="cardbody">
            <form action="" method="POST" class="formsample">
              <div class="form-group">
                <label class="form-text">First Name</label>
                <input type="text" name="studentfname" id="errormsg" value="" class="form-control" required='true' oninput="validateInputs()">
                <div class="errormsgcss"><span id="errorf" class="errormsg"></span></div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Lastname</label>
                <input type="text" name="studentlname" id="errormsg2" value="" class="form-control" required='true' oninput="validateInputs2()">
                <div class="errormsgcss"><span id="errorl" class="errormsg"></span></div>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Email</label>
                <input type="text" name="studentemail" value="" class="form-control" id="errore" required='true' oninput="validateInputs3()">
                <div class="errormsgcss"><span id="errormsge" class="errormsg"></span></div>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Phone</label>
                <input type="text" name="studentphone" value="" class="form-control" id="errorp" required='true' oninput="validateInputs4()">
                <div class="errormsgcss"><span id="errormsgp" class="errormsg"></span></div>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Age</label>
                <input type="number" name="studentage" id="studentage" value="" class="form-control" required='true' oninput="validateUserAge()">
                <div class="errormsgcss"><span id="errormsgage" class="errormsg"></span></div>
              </div>
              <div class="form-group">
                <?php
                $query = "select * from coursedetails";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                  echo "<label for='columns' class='form-text'>Select a course:</label><br>";
                  echo "<select id='showdata' name='selected_column' class= 'form-control'>";
                  // Output data of each row
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['Coursename'] . "' class= 'option-control'>" . $row['Coursename'] . "</option>";
                  }
                  echo "</select>";
                } else {
                  echo "<div class='btndiv'>0 Results</div>";
                }
                ?>
              </div>
              <h3>Login Details</h3>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Username</label>
                <input type="text" name="susername" value="" class="form-control" required='true' oninput="checkUsername()">
              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Password</label>
                <input type="text" name="tpassword1" value="" class="form-control" id="password1" required='true'>
              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Confirm Password</label>
                <input type="text" name="tpassword2" value="" class="form-control" id="password2" required='true' oninput="validatePass()">
                <div class="errormsgcss"><span id="errormsgcp" class="errormsg"></span></div>
              </div>
              <div class="btndiv"><button class="btn" name="submit" value="submit">Add Student</button>
              </div>
              <?php
              include("components/dbconnection.php");
              if (isset($_POST['submit'])) {
                function sanitizeInput($data)
                {
                  return htmlspecialchars(strip_tags($data));
                }
                $showdata = $_POST['selected_column'];
                $sqlquery = "select CourseID from coursedetails where Coursename='$showdata' ";
                $res = mysqli_query($con, $sqlquery);
                $row = mysqli_fetch_array($res);
                $studentcourse = $row['CourseID'];
                $firstname = sanitizeInput($_POST['studentfname']);
                $lastname = sanitizeInput($_POST['studentlname']);
                $email = sanitizeInput($_POST['studentemail']);
                $phone = sanitizeInput($_POST['studentphone']);
                $age = sanitizeInput($_POST['studentage']);
                $username = sanitizeInput($_POST['susername']);
                $password = $_POST['tpassword1']; // Hash the password
                $sqlcheck = "Select * from studentdetails where Username = '$username'";
                $rescheck = mysqli_query($con, $sqlcheck);
                if (mysqli_num_rows($rescheck) <= 0) {
                  // SQL query to insert data into the database
                  $sql = "INSERT INTO studentdetails (CourseID, Firstname, Lastname, Email,Phone, Age, Username, Password)
        VALUES ('$studentcourse', '$firstname', '$lastname', '$email', '$phone', '$age', '$username', '$password')";

                  // Execute the query
                  if ($con->query($sql) === TRUE) {
                    echo "<div class='btndiv'>Data Inserted Successfully</div>";
                  } else {
                    echo "<div class='btndiv'>Data wasn't Inserted</div>";
                  }
                }
              }
              // Close the database connection
              ?>

            </form>

          </div>
        </div>
      </div>
    </div>

  </div>


  <script src="admin.js">

  </script>
</body>

</html>