<?php 
include("components/adminHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/sidebar.css"/>
    <title>Document</title>
</head>
<body>
    <div class="sidebar">
        <div class="usertext">
    <label>Admin Panel</label></div>
    <div class="line"></div>
     <a href="dashboard.php" class="sidetext">Dashboard</a>
    <a href="#" onclick="toggleDropdown('student')" class="sidetext">Student</a>
    <div class="dropdown" id="studentDropdown">
        <a href="StudentDetails.php" class="droptext">Add Student</a>
        <a href="StudentList.php" class="droptext">Student List</a>
        <a href="EditStudentDetails.php" class="droptext">Edit Student</a>
    </div>
    <a href="#" onclick="toggleDropdown('teacher')" class="sidetext">Teacher</a>
    <div class="dropdown" id="teacherDropdown">
        <a href="TeacherDetails.php" class="droptext">Add Teacher</a>
        <a href="TeacherList.php" class="droptext">Teacher List</a>
        <a href="EditDetails.php" class="droptext">Edit Details</a>
    </div>
    <a href="#" onclick="toggleDropdown('course')" class="sidetext">Course</a>
    <div class="dropdown" id="courseDropdown">
        <a href="CourseDetails.php" class="droptext">Add Course</a>
        <a href="SubjectDetails.php" class="droptext">Add Subject</a>
        <a href="CourseList.php" class="droptext">Course/Subject List</a>
        <a href="EditCourseDetails.php" class="droptext">Edit Course</a>
    </div>
    <a href="viewfeedback.php" class="sidetext" style="margin-bottom: 20px;">Feedback</a>

    </div>
<script>
function toggleDropdown(menu) {
        const dropdown = document.getElementById(menu + 'Dropdown');
        dropdown.style.maxHeight = dropdown.style.maxHeight === '0px' ? '300px' : '0px';
    }
</script>
</body>
</html>