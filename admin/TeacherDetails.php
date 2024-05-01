<?php
session_start();
include('components/sidebar.php');
include("components/dbconnection.php");
if (isset($_SESSION['username'])) {
$errors = [];

function sanitizeInput($data)
{
    global $con;
    return mysqli_real_escape_string($con, htmlspecialchars(strip_tags($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate inputs
    $firstname = sanitizeInput($_POST['teacherfname']);
    if (strlen($firstname) > 20) {
        $errors['firstname'] = "Firstname must be 20 characters or less";
    }

    $lastname = sanitizeInput($_POST['teacherlname']);
    if (strlen($lastname) > 20) {
        $errors['lastname'] = "Lastname must be 20 characters or less";
    }

    $email = sanitizeInput($_POST['teacheremail']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    $phone = sanitizeInput($_POST['teacherphone']);
    if (!ctype_digit($phone) || strlen($phone) != 10) {
        $errors['phone'] = "Phone number must be numeric and contain 10 digits";
    }
    $username = sanitizeInput($_POST['tusername']);
    if (strlen($username) > 20) {
        $errors['username'] = "Username must be 20 characters or less";
    }

    $password1 = $_POST['tpassword1'];
    $password2 = $_POST['tpassword2'];
    if ($password1 !== $password2) {
        $errors['password'] = "Passwords do not match";
    }
    if (empty($errors)) {
        $firstname = mysqli_real_escape_string($con, $_POST['teacherfname']);
        $lastname =  mysqli_real_escape_string($con, $_POST['teacherlname']);
        $email =  mysqli_real_escape_string($con, $_POST['teacheremail']);
        $phone =  mysqli_real_escape_string($con, $_POST['teacherphone']);
        $education =  mysqli_real_escape_string($con, $_POST['teducation']);
        $subjectsTaken =  mysqli_real_escape_string($con, $_POST['subjectstaken']);
        $username =  mysqli_real_escape_string($con, $_POST['tusername']);
        $password = mysqli_real_escape_string($con,  mysqli_real_escape_string($con,  password_hash($_POST['tpassword1'], PASSWORD_DEFAULT))); // Hash the password
        $sqlcheck = "Select * from teacherdetails where Username = '$username'";
        $rescheck = mysqli_query($con, $sqlcheck);
        if (mysqli_num_rows($rescheck) <= 0) {
            // SQL query to insert data into the database
            $sql = "INSERT INTO teacherdetails (Firstname, Lastname, Email, Phone, SubjectsTaken, Education, Username, Password)
VALUES ('$firstname', '$lastname', '$email', '$phone', '$subjectsTaken', '$education', '$username', '$password')";

            // Execute the query
            if ($con->query($sql) === TRUE) {
                $errors['db-insertion'] = "Data Inserted Successfully";
            } else {
                $errors['db-insertion'] = "Data wasn't Inserted";
            }
        } else {
            $errors['usernameduplication'] = "cannot enroll the student, Username already exists!";
        }
    }
}
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
                                <input type="text" name="teacherfname" id="errormsg" value="<?= isset($_POST['teacherfname']) ? htmlspecialchars($_POST['teacherfname']) : ''; ?>" class="form-control" required='true' ">
                <?php if (isset($errors['firstname'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['firstname']}</span></div>"; ?></div>
          <div class=" form-group">
                                <label for="exampleInputName1" class="form-text">Lastname</label>
                                <input type="text" name="teacherlname" id="errormsg2" value="<?= isset($_POST['teacherlname']) ? htmlspecialchars($_POST['teacherlname']) : ''; ?>" class="form-control" required='true'>
                                <?php if (isset($errors['lastname'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['lastname']}</span></div>"; ?>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Email</label>
                                <input type="text" name="teacheremail" value="<?= isset($_POST['teacheremail']) ? htmlspecialchars($_POST['teacheremail']) : ''; ?>" class="form-control" id="errore" required='true'>
                                <?php if (isset($errors['email'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['email']}</span></div>"; ?>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Phone</label>
                                <input type="text" name="teacherphone" value="<?= isset($_POST['teacherphone']) ? htmlspecialchars($_POST['teacherphone']) : ''; ?>" class="form-control" id="errorp" required='true'>
                                <?php if (isset($errors['phone'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['phone']}</span></div>"; ?>
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
                                <input type="text" name="tusername" value="<?= isset($_POST['tusername']) ? htmlspecialchars($_POST['tusername']) : ''; ?>" class="form-control" required='true'>
                                <?php if (isset($errors['username'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['username']}</span></div>"; ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Password</label>
                                <input type="text" name="tpassword1" value="<?= isset($_POST['tpassword1']) ? htmlspecialchars($_POST['tpassword1']) : ''; ?>" class="form-control" id="password1" required='true'>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Confirm Password</label>
                                <input type="text" name="tpassword2" value="<?= isset($_POST['tpassword2']) ? htmlspecialchars($_POST['tpassword2']) : ''; ?>" class="form-control" id="password2" required='true' <div class="errormsgcss"><span id="errormsgcp" class="errormsg"></span>
                                <?php if (isset($errors['password'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['password']}</span></div>"; ?>
                            </div>
                            <div class="btndiv"><button class="btn" name="submit" value="submit">Add Teacher</button>
                        </form>
                        <?php if (isset($errors['db-insertion'])) echo "<div class='btndiv'>{$errors['db-insertion']}</div>"; ?>
                        <?php if (isset($errors['usernameduplication'])) echo "<div class='btndiv'>{$errors['usernameduplication']}</div>";
                        
}
else{
    header("Location:index.php");
}?>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="admin.js">

    </script>
</body>

</html>