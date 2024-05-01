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
    <link rel="stylesheet" type="text/css" href="style/adminloginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Change Password</title>
</head>

<body>
    <header>
        <h2>
          ClassMentor
        </h2>
    </header>
    <div class="login-container">
        <form action="" method="POST">
            <div class="usernameform" style="font-size:2rem;">
            <label for="" >Change Password</label>
            </div>
            <label for="">New Password:</label><br>
            <div class="usernameform">
                <input type="text" name="password1" class="box" style="margin-top: 10px;"/><br>
            </div>
            <label for="">Confirm New Password:</label><br>
            <div class="usernameform">
                <input type="text" name="password2" class="box" style="margin-top: 10px;"/><br>
            </div>

            <?php
            if (isset($_POST['change-password'])) {
                $_SESSION['info'] = "";
                $password = mysqli_real_escape_string($con, $_POST['password1']);
                $cpassword = mysqli_real_escape_string($con, $_POST['password2']);
                if ($password !== $cpassword) {
                    echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>Confirm password not matched!</div>";
                } else {
                    $code = 0;
                    $email = $_SESSION['email'];
                    $encpass = $password;
                    $update_pass = "UPDATE adminlogin SET code = $code, password = '$encpass' WHERE email = '$email'";
                    $run_query = mysqli_query($con, $update_pass);
                    if ($run_query) {
                       
                        echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>password changed successfully!</div>";
                    } else {
                        echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>Failed to change your password!</div>";
                    }
                }
            }
            ?>
            <div class="usernameform">
                <button type="submit" name="change-password" class="btn" style="height: 40px; width:200px; margin-top:20px;">Change Password</button>
            </div>
        </form>
    </div>
</body>

</html>