<?php
include('components/connect.php');
include('components/sidebar.php');
$sql = "Select Announcementtitle, AnnouncementID from announcementdetails";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        <div class="table-control">
        <h1 class="heading-text">Notice/Manage Notice</h1>
            <?php
        if (mysqli_num_rows($result)>0) {
       ?>
        
                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Sr No</th>
                        <th>Announcement Title</th>
                        <th>Remove</th>
                    </tr>

        <?php
            $i = 1;
            while ($result3 = mysqli_fetch_assoc($result)) {
          
                echo "  
         <tr class='data'>  
              <td>" .$i. "</td>  
              <td>" . $result3['Announcementtitle'] . "</td>
              <td><a href='delete.php?id=" . $result3['AnnouncementID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt'  ></i> Delete</a></td>
              
         </tr>  
    ";
    $i++;
            }
        } else {
            echo "<div class='successmsg'><label class='successtext'>Data not found</label><br>
            <label class='successtext'>To Post New Announcements <br><div class='btndiv'><a href='add-notice.php' class='button deletetext'>Click Here!</a></div></label></div>";
        }
    
?>
</div>
     
        
    </section>
</body>

</html>