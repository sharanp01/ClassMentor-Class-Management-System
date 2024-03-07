<?php
include('components/connect.php');
include('components/sidebar.php');
$sql = "Select * from timetabledetails "; /* TeacherID='".$_SESSION['user']."' */
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                <a href="logout.php"><button class="Btn">
                        <div class="sign"><svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg></div>
                        <div class="text">Logout</div>
                    </button>
                   </a>
                </div>
            </div>
        </div>
        <div class="table-control">
            <h1 class="heading-text">Timetable/Manage Lectures</h1>
            <?php
            if (mysqli_num_rows($result) > 0) {
            ?>

                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Remove</th>
                    </tr>

                <?php
                $i = 1;
                while ($result3 = mysqli_fetch_assoc($result)) {

                    echo "  
         <tr class='data'>  
              <td>" . $i . "</td>  
              <td>" . $result3['Date'] . "</td>
              <td>" . $result3['Starttime'] . "</td>
              <td>" . $result3['Endtime'] . "</td>
              <td><a href='deletelectures.php?id=" . $result3['TimetableID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt'  ></i> Delete</a></td>
              
         </tr>  
    ";
                    $i++;
                }
            } else {
                echo "<div class='successmsg'><label class='successtext'>Data not found</label><br>
            <label class='successtext'>No lectures Schedules To Schedule New Lectures <br><div class='btndiv'><a href='timetabledetails.php' class='button deletetext'>Click Here!</a></div></label></div>";
            }

                ?>
        </div>
    </section>
</body>

</html>