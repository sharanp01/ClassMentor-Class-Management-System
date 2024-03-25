<?php
session_start();
include("components/connect.php");
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
    <title>Reset Code</title>
</head>

<body>
    <div class="maincontainer">
        <div class="logincontainer">
            <div class="logintitle">
                <label for="" class="logintitletext">ClassMentor-Reset Code</label>
            </div>
            <div class="formgroup">
                <form action="" method="POST">
                    <div class="formcontrol">
                        <label for="" class="logintitletext" style="font-size: 1.2rem;">
                            <?php
                            echo $_SESSION["info"];
                            ?>
                        </label>
                    </div>
                    <div class="formcontrol"><input type="text" name="code" id="username" placeholder="Enter the code" required><br>
                        <label for="" style="font-size:1rem; position:absolute; left:262px; color: white; margin-top:10px; margin-bottom:10px;">Please enter reset code </label>
                    </div>
                    <div class="btndiv" style="margin-top: 50px;">
                        <button type="submit" name="submit" class="btn">Submit</button>
                    </div>
                    <div class="loginvalidation">
                        <?php
                        if (isset($_POST['submit'])) {
                            if (isset($_SESSION["checkboxstatus"])) {
                                $_SESSION['info'] = "";
                                $otp_code = mysqli_real_escape_string($conn, $_POST['code']);
                                $check_code = "SELECT * FROM studentdetails WHERE code = $otp_code";
                                $code_res = mysqli_query($conn, $check_code);
                                if (mysqli_num_rows($code_res) > 0) {
                                    $fetch_data = mysqli_fetch_assoc($code_res);
                                    $email = $fetch_data['Email'];
                                    $_SESSION['Email'] = $email;
                                    $info = "Student, Please create a new password that you don't use on any other site.";
                                    $_SESSION['info'] = $info;
                                    header('location: new-password.php');
                                    exit();
                                } else {
                                    echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>You have entered the incorrect code!</div>";
                                }
                            } else {
                                $_SESSION['info'] = "";
                                $otp_code = mysqli_real_escape_string($conn, $_POST['code']);
                                $check_code = "SELECT * FROM teacherdetails WHERE code = $otp_code";
                                $code_res = mysqli_query($conn, $check_code);
                                if (mysqli_num_rows($code_res) > 0) {
                                    $fetch_data = mysqli_fetch_assoc($code_res);
                                    $email = $fetch_data['Email'];
                                    $_SESSION['Email'] = $email;
                                    $info = "Teacher, Please create a new password that you don't use on any other site.";
                                    $_SESSION['info'] = $info;
                                    header('location: new-password.php');
                                    exit();
                                } else {
                                    echo "<div style='color:red; margin-bottom:20px; font-size:1rem;'>You have entered the incorrect code!</div>";
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