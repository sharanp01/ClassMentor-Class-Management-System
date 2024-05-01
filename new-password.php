<?php
include("components/connect.php");
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
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Change Password</title>
</head>

<body>
    <div class="maincontainer">
        <div class="logincontainer">
            <div class="logintitle">
                <label for="" class="logintitletext">ClassMentor-Change Password</label>
            </div>
            <div class="formgroup">
                <form action="" method="POST">
                    <div class="formcontrol" style="margin-top:20px;">
                        <label for="" class="logintitletext" style="font-size: 1.2rem;">
                            <?php
                            echo $_SESSION["info"];
                            ?>
                        </label>
                    </div>
                    <div class="formcontrol" style="margin-top:20px;"><input type="text" name="password1" id="username" placeholder="Enter new password" required><br>
                    </div>
                    <div class="formcontrol"><input type="text" name="password2" id="username" placeholder="Confirm new password" required><br>
                    </div>
                    <div class="btndiv" style="margin-top:none;">
                        <button type="submit" name="submit" class="btn">Change password</button>
                    </div>
                    <div class="loginvalidation">
                        <?php
                        if (isset($_POST['submit'])) {
                            if (isset($_SESSION["checkboxstatus"])) {
                                $_SESSION['info'] = "";
                                $password = mysqli_real_escape_string($conn, $_POST['password1']);
                                $cpassword = mysqli_real_escape_string($conn, $_POST['password2']);
                                if ($password !== $cpassword) {
                                    echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Confirm password not matched!</div>";
                                } else {
                                    $code = 0;
                                    $email = $_SESSION['email'];
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                                    $encpass = $password;
                                    $update_pass = "UPDATE studentdetails SET code = $code, Password = '$encpass' WHERE Email = '$email'";
                                    $run_query = mysqli_query($conn, $update_pass);
                                    if ($run_query) {
                                        echo "<div style='color:lightgreen; margin-bottom:20px; font-size:1rem;'>password changed successfully!</div>";
                                    } else {
                                        echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Failed to change your password!</div>";
                                    }
                                }
                            } else {
                                $_SESSION['info'] = "";
                                $password = mysqli_real_escape_string($conn, $_POST['password1']);
                                $cpassword = mysqli_real_escape_string($conn, $_POST['password2']);
                                if ($password !== $cpassword) {
                                    echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Confirm password not matched!</div>";
                                } else {
                                    $code = 0;
                                    $email = $_SESSION['email'];
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                                    $encpass = $password;
                                    $update_pass = "UPDATE teacherdetails SET code = $code, Password = '$encpass' WHERE Email = '$email'";
                                    $run_query = mysqli_query($conn, $update_pass);
                                    if ($run_query) {
                                        echo "<div style='color:lightgreen; margin-bottom:20px; font-size:1rem;'>password changed successfully!</div>";
                                    } else {
                                        echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>Failed to change your password!</div>";
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>