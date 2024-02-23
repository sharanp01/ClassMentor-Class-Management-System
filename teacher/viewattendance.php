<?php
include('components/connect.php');
include('components/sidebar.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Document</title>
    <style> body{ background-color:#E4E9F7  ;}</style>
</head>

<body>
    <div class="home-section">
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
        <h1>Attendance/View Attendance</h1>
            <form action="" method="POST">
                <div class="input-control">
                    <label for="" class="input-text">Enter Date:</label>
                <input type="date" id="date" name="inputdate" placeholder="yyyy-mm-dd"/>
                <div class="btndiv"><button type="submit" name="submit" id="button" class="button">Submit</button></div>
                </div>
            </form>
 <?php 
 if(isset($_POST['submit'])){
    $date = $_POST['inputdate'];
    $sql =  "SELECT studentdetails.Firstname, studentdetails.Lastname, subjectdetails.Subjectname, attendancedetails.Date, attendancedetails.Status
    FROM attendancedetails 
    INNER JOIN studentdetails ON attendancedetails.StudentID = studentdetails.StudentID
    INNER JOIN subjectdetails ON attendancedetails.SubjectID = subjectdetails.SubjectID
     WHERE attendancedetails.Date = '$date'";  
     $result = mysqli_query($conn ,$sql);
     
    
     if ($result) {
       ?>
        
                <table border="1" cellspacing="6" cellpadding="6" id="attendancetable">
                    <tr class="heading">
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Subject Name</th>
                        <th>Date</th>
                        <th>Attendence Status</th>
                    </tr>

        <?php
            $i = 1;
            while ($result3 = mysqli_fetch_assoc($result)) {
          
                echo "  
         <tr class='data'>  
              <td>" . $result3['Firstname'] . "</td>  
              <td>" . $result3['Lastname'] . "</td>  
              <td>" . $result3['Subjectname'] . "</td>  
              <td>" . $result3['Date'] . "</td>  
              <td class ='status' id='status'>" . $result3['Status'] . "</td>  
         </tr>  
    ";
    $i++;
            }
        } else {
            echo "<div class='btndiv'>Data not found</div>";
        }
    } 
?>

<script>
 document.addEventListener("DOMContentLoaded", function() {
    var table = document.getElementById("attendanceTable");
    var rows = table.getElementsByTagName("tr");

    // Loop through each row (skipping the first row, which is the header)
    for (var i = 1; i < rows.length; i++) {
        var cell = rows[i].getElementsByClassName("status")[0];
        var status = cell.textContent.trim().toLowerCase();

        // Set background color based on status
        if (status === 'Present') {
            cell.style.backgroundColor = 'lightgreen';
        } else if (status === 'Absent') {
            cell.style.backgroundColor = 'lightred';
        }
    }
});

</script>

    </div>
</body>

</html>