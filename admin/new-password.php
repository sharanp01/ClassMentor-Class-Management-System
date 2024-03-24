<?php
include("components/dbconnection.php");
session_start();
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: index.php');
}
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
        <label for="">New Password:</label><br>
        <input type="text" name="password1" /><br>
        <label for="">Confirm New Password:</label><br>
        <input type="text" name="password2" /><br>
        <button type="submit" name="change-password">Change Password</button>
        <?php
        if (isset($_POST['change-password'])) {
            $_SESSION['info'] = "";
            $password = mysqli_real_escape_string($con, $_POST['password1']);
            $cpassword = mysqli_real_escape_string($con, $_POST['password2']);
            if ($password !== $cpassword) {
                echo "Confirm password not matched!";
            } else {
                $code = 0;
                $email = $_SESSION['email']; 
                $encpass = $password;
                $update_pass = "UPDATE adminlogin SET code = $code, password = '$encpass' WHERE email = '$email'";
                $run_query = mysqli_query($con, $update_pass);
                if ($run_query) {
                    /* $info = "Your password changed. Now you can login with your new password.";
                    $_SESSION['info'] = $info;
                    header('Location: password-changed.php'); */
                    echo "password changed successfully";
                } else {
                    echo "Failed to change your password!";
                }
            }
        }
        ?>
    </form>
</body>

</html>