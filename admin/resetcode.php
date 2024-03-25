<?php
session_start();
include("components/dbconnection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/adminloginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Reset Code</title>
</head>

<body>
    <header>
        <h2>ClassMentor</h2>
    </header>
    <div class="login-container" style="height: 320px; ">
        <form action="" method="POST">
            <div class="usernameform" style="font-size:2rem;">
                <label for="">Reset Code</label>
            </div>
            <div class="usernameform">
                <label for="">Reset Code was sent to <?php echo $_SESSION['email']; ?></label><br>
            </div>
            <div class="usernameform">
                <label for="">Enter the Code:</label><br>
                <input type="number" name="code"  maxlength="6" class="box" style="margin-top: 10px;" />
            </div>
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
                    echo "<div style='color:red; margin-bottom:20px; font-size:0.8rem;'>You have entered the incorrect code!</div>";
                }
            }

            ?>
            <div class="usernameform">
                <button type="submit" name="reset-code" class="btn">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>