<?php 
include('components/sidebar.php');
include('components/connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="home-section">

<div class="home-content">
    <div class="left-content">
        ClassMentor
    </div>
    <div class="right-content">
        <label for="" class="dropdowntext">Welcome</label>
        <div class="dropdown">

            <button class="dropbtn">Dropdown</button>
            <div class="dropdown-content">
                <a href="#">Profile</a>
                <a href="#">Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="resource-control">
    <?php echo "HELLO Sathya04";?>
</div>
</section>
</body>
</html>