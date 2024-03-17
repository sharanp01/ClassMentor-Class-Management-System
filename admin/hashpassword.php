<?php
include("components/dbconnection.php");

if (isset($_POST['submit'])) {
    // Assume user-supplied password
    $user_supplied_password = "1234";

    // Retrieve hashed password from the database
    $passwordsql = "SELECT Password FROM teacherdetails WHERE Username = 'yash04'";
    $result = $con->query($passwordsql);

    if ($result->num_rows > 0) {
        // Fetch the hashed password
        $row = $result->fetch_assoc();
        $hashed_password = $row["Password"];

        // Use password_verify() to check if the user-supplied password matches the hashed password
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