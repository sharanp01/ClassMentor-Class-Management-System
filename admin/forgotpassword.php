<?php
include("components/dbconnection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/adminloginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Forgot Password</title>
</head>

<body>
    <header>
        <h2>ClassMentor</h2>
    </header>
    <div class="login-container" style="height: 300px; ">
        <form action="" method="POST">
            <div class="usernameform" style="font-size:2rem;">
                <label for="">Forgot Password </label>
            </div>
            <div class="usernameform">
                <label for="">Enter an Email:</label><br>
                <input type="text" name="email" class="box" style="margin-top: 10px;" />
            </div>
            <?php
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $check_email = "SELECT * FROM adminlogin WHERE email='$email'";
                $run_sql = mysqli_query($con, $check_email);
                if (mysqli_num_rows($run_sql) > 0) {
                    $code = rand(999999, 111111);
                    $insert_code = "UPDATE adminlogin SET code = $code WHERE email = '$email'";
                    $run_query =  mysqli_query($con, $insert_code);
                    if ($run_query) {
                        $subject = "Password Reset Code";
                        $message = "Your password reset code is $code";
                        $sender = "From: classmentor0131@gmail.com";
                        if (mail($email, $subject, $message, $sender)) {
                            $info = "We've sent a passwrod reset otp to your email - $email";
                            $_SESSION['info'] = $info;
                            $_SESSION['email'] = $email;
                            header('location: resetcode.php');
                            exit();
                        } else {
                            echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>Failed Sending code!</div>";
                        }
                    } else {
                        echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>Something went wrong!Please try again</div>";
                    }
                } else {
                    echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>Email doesnt exist please try another email</div>";
                }
            } ?>
             <div class="usernameform">
                <button type="submit" name="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>