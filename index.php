<?php
include('components/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Login Page</title>
</head>

<body>
    <div class="maincontainer">
        <div class="logincontainer">
            <div class="logintitle">
                <label for="" class="logintitletext">ClassMentor-Login</label>
            </div>
            <div class="formgroup">
                <form action="" method="POST">
                    <div class="formcontrol"><input type="text" name="username" id="username" placeholder="Username" required><br></div>
                    <div class="formcontrol"><input type="password" name="password" placeholder="Password" required><br></div>
                    <div class="btndiv">
                        <button type="submit" name="submit" class="btn">Login</button>
                    </div>
                    <div class="loginvalidation">
                        <?php
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['login'])) {
                                $username = $_POST['username'];
                                $password = $_POST['password'];
                                $username = stripcslashes($username);
                                $password = stripcslashes($password);
                                $username = mysqli_real_escape_string($conn, $username);
                                $password = mysqli_real_escape_string($conn, $password); 
                                $sql = "select * from studentdetails where Username = '$username'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = $result->fetch_assoc();
                                    $check = password_verify($password, $row['Password']);
                                    if ($check == 1) {
                                        $_SESSION['username'] = $username;
                                        header("location:student/studentdashboard.php");
                                        exit();
                                       
                                    } else {
                                        echo "<label class='error-msg'>Invalid password</label>";
                                    }
                                } else {
                                    echo "<label class='error-msg'>Invalid username</label>";
                                }
                            } else {
                                $username = $_POST['username'];
                                $password = $_POST['password'];
                                $username = stripcslashes($username);
                                $password = stripcslashes($password);
                                $username = mysqli_real_escape_string($conn, $username);
                                $password = mysqli_real_escape_string($conn, $password);

                                $sql = "select * from teacherdetails where Username = '$username'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = $result->fetch_assoc();
                                    $check = password_verify($password, $row['Password']);
                                    if ($check == 1) {
                                        $_SESSION['username'] = $username;
                                        header("location:teacher/teacherdashboard.php");
                                        exit();
                                       
                                    } else {
                                        echo "<label class='error-msg'>Invalid password</label>";
                                    }
                                } else {
                                    echo "<label class='error-msg'>Invalid username</label>";
                                }
                            }
                        }
                        ?>
                    </div>
                  
                    <div class="switch2">
                        <label for=""><a href="forgot-password.php" class="forgot-password">Forgot Password?</a></label>
                        <div class="switch3">
                            <label class="switch">
                                <input type="checkbox" name="login">
                                <div class="slider">
                                    <span>Teacher</span>
                                    <span>Student</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>