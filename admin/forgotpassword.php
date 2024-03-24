<?php
include("components/dbconnection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Enter the email</label>
        <input type="text" name="email" />
        <button type= "submit" name="submit">Submit</button>
    </form>
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
                    $errors['otp-error'] = "Failed while sending code!";
                }
            } else {
                $errors['db-error'] = "Something went wrong!";
            }
        } else {
           echo "Email doesnt exist please try another email";
        }
    } ?>
</body>

</html>