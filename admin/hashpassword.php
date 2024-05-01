<?php
include("components/dbconnection.php");

if (isset($_POST['submit'])) {
  
    $user_supplied_password = "1234";

 
    $passwordsql = "SELECT Password FROM teacherdetails WHERE Username = 'yash04'";
    $result = $con->query($passwordsql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $hashed_password = $row["Password"];

      
        if (password_verify($user_supplied_password, $hashed_password)) {
            echo "Password is correct!";
        } else {
            echo "Password is incorrect!";
        }
    } else {
        echo "Username not found!";
    }
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
    <form action="" method="post">
       <button class="submit" name="submit">Click here</button>
    </form>
</body>
</html>