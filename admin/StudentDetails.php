<?php
include('components/dbconnection.php');
include('components/sidebar.php');

$errors = [];

function sanitizeInput($data)
{
    global $con;
    return mysqli_real_escape_string($con, htmlspecialchars(strip_tags($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate inputs
    $firstname = sanitizeInput($_POST['studentfname']);
    if (strlen($firstname) > 20) {
        $errors['firstname'] = "Firstname must be 20 characters or less";
    }

    $lastname = sanitizeInput($_POST['studentlname']);
    if (strlen($lastname) > 20) {
        $errors['lastname'] = "Lastname must be 20 characters or less";
    }

    $email = sanitizeInput($_POST['studentemail']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    $phone = sanitizeInput($_POST['studentphone']);
    if (!ctype_digit($phone) || strlen($phone) != 10) {
        $errors['phone'] = "Phone number must be numeric and contain 10 digits";
    }

    // Initialize $showdata to avoid undefined variable warning
    $showdata = '';

    if (isset($_POST['selected_column'])) {
        $showdata = sanitizeInput($_POST['selected_column']);
    }

    $username = sanitizeInput($_POST['susername']);
    if (strlen($username) > 20) {
        $errors['username'] = "Username must be 20 characters or less";
    }

    $password1 = $_POST['tpassword1'];
    $password2 = $_POST['tpassword2'];
    if ($password1 !== $password2) {
        $errors['password'] = "Passwords do not match";
    }

    if (empty($errors)) {
        $sqlcheck = "SELECT * FROM studentdetails WHERE Username = '$username'";
        $rescheck = mysqli_query($con, $sqlcheck);
        if (mysqli_num_rows($rescheck) <= 0) {
            $sqlquery = "SELECT CourseID FROM coursedetails WHERE Coursename='$showdata'";
            $res = mysqli_query($con, $sqlquery);
            $row = mysqli_fetch_array($res);
            $studentcourse = $row['CourseID'];
            $firstname =  mysqli_real_escape_string($con, ($_POST['studentfname']));
            $lastname =  mysqli_real_escape_string($con, ($_POST['studentlname']));
            $email = mysqli_real_escape_string($con, ($_POST['studentemail']));
            $phone =  mysqli_real_escape_string($con, ($_POST['studentphone']));
            $age =  mysqli_real_escape_string($con, ($_POST['studentage']));
            $username =  mysqli_real_escape_string($con, ($_POST['susername']));
            $password = $_POST['tpassword1']; // Hash the password
            $password = mysqli_real_escape_string($con,  password_hash($password, PASSWORD_DEFAULT));
            $sqlcheck = "Select * from studentdetails where Username = '$username'";
            $rescheck = mysqli_query($con, $sqlcheck);
            if (mysqli_num_rows($rescheck) <= 0) {
                // SQL query to insert data into the database
                $sql = "INSERT INTO studentdetails (CourseID, Firstname, Lastname, Email,Phone, Age, Username, Password)
                         VALUES ('$studentcourse', '$firstname', '$lastname', '$email', '$phone', '$age', '$username', '$password')";

                // Execute the query
                if ($con->query($sql) === TRUE) {
                    $errors['db-insertion'] = "Data Inserted Successfully";
                } else {
                   $errors['db-insertion'] = "Data wasn't Inserted";
                }
            }
        }
    } else {
        $errors['usernameduplication'] = "cannot enroll the student, Username already exists!";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/teacherstyle.css" />
    <title>Student Details</title>
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
                            <!-- First Name -->
                            <div class="form-group">
                                <label class="form-text">First Name</label>
                                <input type="text" name="studentfname" value="<?= isset($_POST['studentfname']) ? htmlspecialchars($_POST['studentfname']) : ''; ?>" class="form-control" required>
                                <?php if (isset($errors['firstname'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['firstname']}</span></div>"; ?>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Lastname</label>
                                <input type="text" name="studentlname" value="<?= isset($_POST['studentlname']) ? htmlspecialchars($_POST['studentlname']) : ''; ?>" class="form-control" required>
                                <?php if (isset($errors['lastname'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['lastname']}</span></div>"; ?>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Email</label>
                                <input type="email" name="studentemail" value="<?= isset($_POST['studentemail']) ? htmlspecialchars($_POST['studentemail']) : ''; ?>" class="form-control" required>
                                <?php if (isset($errors['email'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['email']}</span></div>"; ?>
                            </div>
                            <!-- Phone -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Phone</label>
                                <input type="text" name="studentphone" value="<?= isset($_POST['studentphone']) ? htmlspecialchars($_POST['studentphone']) : ''; ?>" class="form-control" required>
                                <?php if (isset($errors['phone'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['phone']}</span></div>"; ?>
                            </div>
                            <!-- Age -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Age</label>
                                <input type="number" name="studentage" value="<?= isset($_POST['studentage']) ? htmlspecialchars($_POST['studentage']) : ''; ?>" class="form-control" required>
                            </div>
                            <!-- Education -->
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
                            <!-- Username -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Username</label>
                                <input type="text" name="susername" value="<?= isset($_POST['susername']) ? htmlspecialchars($_POST['susername']) : ''; ?>" class="form-control" required>
                                <?php if (isset($errors['username'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['username']}</span></div>"; ?>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Password</label>
                                <input type="password" name="tpassword1" class="form-control" required>
                            </div>
                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-text">Confirm Password</label>
                                <input type="password" name="tpassword2" class="form-control" required>
                                <?php if (isset($errors['password'])) echo "<div class='errormsgcss'><span class='errormsg'>{$errors['password']}</span></div>"; ?>
                            </div>
                            <div class="btndiv">
                                <button class="btn" name="submit" value="submit">Add Student</button>
                            </div>
                        </form>
                        <?php if (isset($errors['db-insertion'])) echo "<div class='btndiv'>{$errors['db-insertion']}</div>"; ?>
                        <?php if (isset($errors['usernameduplication'])) echo "<div class='btndiv'>{$errors['usernameduplication']}</div>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="admin.js"></script>
</body>

</html>