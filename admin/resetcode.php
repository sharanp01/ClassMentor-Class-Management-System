<?php
session_start();
include("components/dbconnection.php");
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
        <label for="">Enter the code:</label>
        <input type="text" name="code" />
        <button type="submit" name="reset-code">Submit</button>
        <?php
        if (isset($_POST['reset-code'])) {
            $_SESSION['info'] = "";
            $otp_code = mysqli_real_escape_string($con, $_POST['code']);
            $check_code = "SELECT * FROM adminlogin WHERE code = $otp_code";
            $code_res = mysqli_query($con, $check_code);
            if (mysqli_num_rows($code_res) > 0) {
                $fetch_data = mysqli_fetch_assoc($code_res);
                $email = $fetch_data['email'];
                $_SESSION['email'] = $email;
                $info = "Please create a new password that you don't use on any other site.";
                $_SESSION['info'] = $info;
                header('location: new-password.php');
                exit();
            } else {
                echo "You've entered incorrect code!";
            }
        }

        ?>
    </form>
</body>

</html>