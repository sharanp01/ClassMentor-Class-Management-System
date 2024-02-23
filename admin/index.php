<?php 
session_start();?>
<html>

<head>
    <title>ClassMentor - Admin login</title>
    <link rel="stylesheet" type="text/css" href="style/adminloginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <header>
        <h2>Class Mentor</h2>
    </header>
    <div id="frm" class="login-container">
        <form name="f1" action="" method="POST">
            <div class="imageshow">
                <img src="images/icon100.png" alt="Login Image" class="imageshow1"/>
            </div>
            <div class="text">
                <h3>Welcome!</h3>
                <h3>hello world</h3>
            </div>
            <div class="passshow">
                Default Name = <span>admin</span> & Password = <span>1234</span>
            </div>
            <div class="usernameform">
                <input type="text" name="user" placeholder="Enter Username" maxlength="20" class="box" /><br>
                <div class="error">
                    <?php if (isset($_POST['Login'])) {
                        if (empty($_POST['user'])) {
                            echo "<span >Please enter your username!</span>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="passform"> <input type="password" name="pass" placeholder="Enter Password" maxlength="20" class="box" /><br>
                <div class="error"><?php if (isset($_POST['Login'])) {
                                        if (empty($_POST['pass'])) {
                                            echo "<span>Please enter your password!</span>";
                                        }
                                    } ?></div>


            </div>

            <div class="btnshow"> <input type="submit" value="Login" name="Login" class="btn"> </div>
            <?php
            include("components/dbconnection.php");
            if (isset($_POST['Login'])) {
                $username = $_POST['user'];
                $password = $_POST['pass'];


                $username = stripcslashes($username);
                $password = stripcslashes($password);
                $username = mysqli_real_escape_string($con, $username);
                $password = mysqli_real_escape_string($con, $password);

                $sql = "select *from adminlogin where username = '$username' and password = '$password'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count == 1) {
                    $_SESSION["username"] = $username;
                    header("Location:dashboard.php");
                    exit();
                } else {
                    $error_msg = true;
                }
            }  
            if (isset($_POST['Login'])) {
                if(!empty($_POST['user']) && !empty($_POST['pass'])){
                if ($error_msg == true) {
            ?><div class="error error_msg"><label>Invalid Username or Password</label></div>
            <?php } }
            } ?>


        </form>
        </section>
    </div>

    <script src="admin.js"></script>
</body>

</html>