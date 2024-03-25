<?php
include("components/connect.php");
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
    <title>Forgot Password</title>
</head>

<body>
    <div class="maincontainer">
        <div class="logincontainer">
            <div class="logintitle">
                <label for="" class="logintitletext">ClassMentor-Forgot Password</label>
            </div>
            <div class="formgroup">
                <form action="" method="POST">
                    <div class="formcontrol"><input type="text" name="email" id="username" placeholder="Enter an Email" required><br>
                        <label for="" style="font-size:1rem; position:absolute; left:262px; color: white; margin-top:10px; margin-bottom:10px;">Please enter a email to receive code</label>
                    </div>

                    <div class="btndiv" style="margin-top: 50px;">
                        <button type="submit" name="submit" class="btn">Send Code</button>
                    </div>
                    <div class="loginvalidation">
                        <?php
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['login'])) {
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $check_email = "SELECT * FROM studentdetails WHERE Email='$email'";
                                $run_sql = mysqli_query($conn, $check_email);
                                if (mysqli_num_rows($run_sql) > 0) {
                                    $code = rand(999999, 111111);
                                    $insert_code = "UPDATE studentdetails SET code = $code WHERE Email = '$email'";
                                    $run_query =  mysqli_query($conn, $insert_code);
                                    if ($run_query) {
                                        $subject = "Password Reset Code";
                                        $message = "Your password reset code is $code";
                                        $sender = "From: classmentor0131@gmail.com";
                                        if (mail($email, $subject, $message, $sender)) {
                                            $info = "We've sent a passwrod reset code to your email - $email";
                                            $_SESSION['info'] = $info;
                                            $_SESSION['email'] = $email;
                                            $_SESSION['checkboxstatus'] = $_POST['login'];
                                            header('location: resetcode.php');
                                            exit();
                                        } else {
                                            echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Failed Sending code!</div>";
                                        }
                                    } else {
                                        echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Something went wrong!Please try again</div>";
                                    }
                                } else {
                                    echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Email doesnt exist please try another email</div>";
                                }
                            } else {
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $check_email = "SELECT * FROM teacherdetails WHERE Email='$email'";
                                $run_sql = mysqli_query($conn, $check_email);
                                if (mysqli_num_rows($run_sql) > 0) {
                                    $code = rand(999999, 111111);
                                    $insert_code = "UPDATE teacherdetails SET code = $code WHERE Email = '$email'";
                                    $run_query =  mysqli_query($conn, $insert_code);
                                    if ($run_query) {
                                        $subject = "Password Reset Code";
                                        $message = "Your password reset code is $code";
                                        $sender = "From: classmentor0131@gmail.com";
                                        if (mail($email, $subject, $message, $sender)) {
                                            $info = "We've sent a passwrod reset code to your email - $email";
                                            $_SESSION['info'] = $info;
                                            $_SESSION['email'] = $email;
                                            $_SESSION['checkboxstatus'] = $_POST['login'];
                                            header('location: resetcode.php');
                                            exit();
                                        } else {
                                            echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Failed Sending code!</div>";
                                        }
                                    } else {
                                        echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Something went wrong!Please try again</div>";
                                    }
                                } else {
                                    echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Email doesnt exist please try another email</div>";
                                }
                            }
                        } ?>
                    </div>
                    <div class="switch2">
                        <div class="switch3" style="margin-left:570px; margin-top:50px;">
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