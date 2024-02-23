<?php
include('components/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
  <title>Teacher details</title>
</head>

<body>
  <div class="mainpage">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="pagetitle">Add Teacher</h3>
      </div>
      <div class="row">
        <div class="card">
          <div class="cardbody">
            <form action="" method="POST" class="formsample">
              <div class="form-group">
                <label class="form-text">First Name</label>
                <input type="text" name="teacherfname" id="errormsg" value="" class="form-control" required='true' oninput="validateInputs()">
                <div class="errormsgcss"><span id="errorf" class="errormsg"></span></div>
              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Lastname</label>
                <input type="text" name="teacherlname" id="errormsg2" value="" class="form-control" required='true' oninput="validateInputs2()">
                <div class="errormsgcss"><span id="errorl" class="errormsg"></span></div>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Email</label>
                <input type="text" name="teacheremail" value="" class="form-control" id="errore" required='true' oninput="validateInputs3()">
                <div class="errormsgcss"><span id="errormsge" class="errormsg"></span></div>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Phone</label>
                <input type="text" name="teacherphone" value="" class="form-control" id="errorp" required='true' oninput="validateInputs4()">
                <div class="errormsgcss"><span id="errormsgp" class="errormsg"></span></div>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Subjects Taken</label>
                <input type="text" name="subjectstaken" id="errormsg3" value="" class="form-control" required='true'>

              </div>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Education</label>
                <input type="text" name="teducation" value="" id="errormsg4" class="form-control" required='true'>
              </div>
              <h3>Login Details</h3>
              <div class="form-group">
                <label for="exampleInputName1" class="form-text">Username</label>
                <input type="text" name="tusername" value="" class="form-control" required='true' oninput="checkUsername()">
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
              <div class="btndiv"><button class="btn" name="submit" value="submit">Add Teacher</button>
              </div>
              <?php
              include("components/dbconnection.php");
              if (isset($_POST['submit'])) {
                function sanitizeInput($data)
                {
                  return htmlspecialchars(strip_tags($data));
                }

                // Retrieve data from the form
                $firstname = sanitizeInput($_POST['teacherfname']);
                $lastname = sanitizeInput($_POST['teacherlname']);
                $email = sanitizeInput($_POST['teacheremail']);
                $phone = sanitizeInput($_POST['teacherphone']);
                $education = sanitizeInput($_POST['teducation']);
                $subjectsTaken = sanitizeInput($_POST['subjectstaken']);
                $username = sanitizeInput($_POST['tusername']);
                $password = password_hash($_POST['tpassword1'], PASSWORD_DEFAULT) ; // Hash the password

                // SQL query to insert data into the database
                $sql = "INSERT INTO teacherdetails (Firstname, Lastname, Email, Phone, SubjectsTaken, Education, Username, Password)
        VALUES ('$firstname', '$lastname', '$email', '$phone', '$subjectsTaken', '$education', '$username', '$password')";

                // Execute the query
                if ($con->query($sql) === TRUE) {
                  echo "<div class='btndiv'>Data inserted successfully!</div>";
                } else {
                  echo "<div class='btndiv'>Error in inserting data</div>";
                }
              }
              

              // Close the database connection
              $con->close();
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