<?php
include('components/connect.php');
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

                                $sql = "select * from studentdetails where Username = '$username' and Password = '$password'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $count = mysqli_num_rows($result);

                                if ($count == 1) {
                                    header("Location:student/studentdashboard.php");
                                    exit();
                                } else {
                                    echo "<label class='error-msg'>Invalid username or password</label>";
                                }
                            } else {
                                $username = $_POST['username'];
                                $password = $_POST['password'];


                                $username = stripcslashes($username);
                                $password = stripcslashes($password);
                                $username = mysqli_real_escape_string($conn, $username);
                                $password = mysqli_real_escape_string($conn, $password);

                                $sql = "select * from teacherdetails where Username = '$username' and Password = '$password'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $count = mysqli_num_rows($result);

                                if ($count == 1) {
                                    header("Location:teacher/teacherdashboard.php");
                                    exit();
                                } else {
                                    echo "<label class='error-msg'>Invalid username or password</label>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <!--  <div class="switch2">
                        <div class="switch3">
                            <label class="switch">
                                <input type="checkbox" name="login">
                                <div class="slider">
                                    <span>Teacher</span>
                                    <span>Student</span>
                                </div>
                            </label>
                        </div>
                        <label for=""><a href="forgot-password.php">Forgot Password?</a></label>
                    </div> -->
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