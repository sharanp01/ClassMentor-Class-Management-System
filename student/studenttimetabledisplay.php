<?php
// Include necessary files and establish database connection
include("components/connect.php");
include('components/sidebar.php');

// Fetch the course ID of the logged-in student
$username = "sathya05";
$studentsql = "SELECT CourseID FROM studentdetails WHERE Username = '" . $username . "'";
$studentresult = mysqli_query($conn, $studentsql);
$row1 = mysqli_fetch_assoc($studentresult);
$col1 = $row1['CourseID'];

// Fetch timetable data for the current date and onwards
$currentDate = date('Y-m-d');
$sql = "SELECT teacherdetails.Firstname, subjectdetails.Subjectname, timetabledetails.Date, timetabledetails.Starttime, timetabledetails.Endtime 
        FROM timetabledetails
        INNER JOIN teacherdetails ON teacherdetails.TeacherID = timetabledetails.TeacherID
        INNER JOIN subjectdetails ON subjectdetails.SubjectID = timetabledetails.SubjectID
        WHERE timetabledetails.CourseID='$col1' AND timetabledetails.Date >='$currentDate'
        ORDER BY timetabledetails.Date ASC, timetabledetails.Starttime ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/studentstyle.css">
    <title>Timetable</title>
    <style>
        /* Add your calendar styling here */
        .calendar {
            display: grid;
            border: 2px solid black;
            margin-top: 30px;
            grid-template-columns: repeat(7, 1fr);
        }

        .calendar-day {
            border: 2px solid black;
           padding-top: 10px;
        }

        .calendar-day-heading {
            font-weight: bold;
        }

        .lecture {
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <section class="home-section">
        <div class="home-content">

            <div class="left-content">
                ClassMentor
            </div>
            <div class="right-content">
               
                <div class="dropdown">
                    <div class="dropdown">
                        <a href="logout.php"><button class="Btn">
                                <div class="sign"><svg viewBox="0 0 512 512">
                                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                    </svg></div>
                                <div class="text">Logout</div>
                            </button>
                        </a>
                    </div>s
                </div>
            </div>
        </div>

        <div class="table-control">
            <h1 class="heading-text">Timetable</h1>
            <div class="calendar">
                <?php
                // Initialize an array to hold timetable data organized by date
                $timetableData = array();

                // Fetch timetable data into the array
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = date('Y-m-d', strtotime($row['Date']));
                    $timetableData[$date][] = $row;
                }

                // Loop through the days starting from the current date
                for ($i = 0; $i < 7; $i++) {
                    $date = date('Y-m-d', strtotime($currentDate . ' + ' . $i . ' day'));
                    $dayName = date('l', strtotime($date));

                    echo '<div class="calendar-day">';
                    echo '<div class="calendar-day-heading lecture">' . $dayName . '</div>';

                    // Check if timetable data exists for the current date
                    if (isset($timetableData[$date])) {
                        // Loop through the timetable data for the current date
                        foreach ($timetableData[$date] as $timetable) {
                            echo '<div class="lecture">';
                            echo '<strong>' . $timetable['Date'] . '</strong><br>';
                            echo '<strong>' . $timetable['Firstname'] . '</strong><br>';
                            echo '<span>' . $timetable['Subjectname'] . '</span><br>';
                            echo '<span>' . date('H:i', strtotime($timetable['Starttime'])) . ' - ' . date('H:i', strtotime($timetable['Endtime'])) . '</span>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No classes scheduled';
                    }

                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
</body>

</html>