<?php
session_start();
include('components/connect.php');
include('components/sidebar.php');
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "select * from teacherdetails where Username= '$username' ";
    $result = mysqli_query($conn, $sql);
    $answer = mysqli_fetch_assoc($result);
    $answer2 = $answer['TeacherID'];
    $sql2 = "select * from subjectdetails where TeacherID = '$answer2'";
    $result2 = mysqli_query($conn, $sql2);
    $subjectanswer = mysqli_fetch_assoc($result2);
    $subjectanswer2 = $subjectanswer['SubjectID'];
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
        <title>View Attendance</title>
        <style>
            body {
                background-color: #E4E9F7;
            }
        </style>
    </head>

    <body>
        <div class="home-section">
            <div class="home-content">
                <div class="left-content">
                    ClassMentor
                </div>
                <div class="right-content">

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
                <h1>Attendance/View Attendance</h1>
                <form action="" method="POST">
                    <div class="input-control">
                        <label for="" class="input-text">Enter Date:</label>
                        <input type="date" id="date" name="inputdate" placeholder="yyyy-mm-dd" />
                        <div class="btndiv"><button type="submit" name="submit" id="button" class="button">Submit</button></div>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $date = $_POST['inputdate'];
                    $sql =  "SELECT studentdetails.Firstname, studentdetails.Lastname, subjectdetails.Subjectname, attendancedetails.Date, attendancedetails.Status
    FROM attendancedetails 
    INNER JOIN studentdetails ON attendancedetails.StudentID = studentdetails.StudentID
    INNER JOIN subjectdetails ON attendancedetails.SubjectID = subjectdetails.SubjectID
     WHERE attendancedetails.Date = '$date' and attendancedetails.SubjectID = '$subjectanswer2'";
                    $result = mysqli_query($conn, $sql);


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