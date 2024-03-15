<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="styles/studentstyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <span class="logo_name">Student Panel</span>
        </div>
        <h1 class="line"></h1>
        <ul class="nav-links">
            <li>
                <a href="studentdashboard.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Test</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="studentquizdisplay.php">Give Test</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Assignments</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="studentassignment.php">Give Assignment</a></li>
                </ul>
            </li>
            
            <li>
                <div class="iocn-link">
                    <a href="studenttimetabledisplay.php">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Timetable</span>
                    </a>
                  
            </li>
            <li>
                <div class="iocn-link">
                    <a href="studentresources.php">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Resource</span>
                    </a>
                    
            </li>
            <li>
                <div class="iocn-link">
                    <a href="studentnoticedisplay.php">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Notices</span>
                    </a>
                    
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Feedback</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#">Create FeedbackForm</a></li>
                </ul>
            </li>
            <!-- <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <label class="name">Prem Sahi</label>
                    </div>
                    <div class="name-job">
                       <label for="" class="Subject">Science</label>
                    </div>
                    <a href="logout.html"> <i class='bx bx-log-out'></i></a>
                </div>
            </li> -->
        </ul>
    </div>
   <!-- <section class="home-section">

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
        <label for="">alnaivn</label>
    </section>-->


    <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    </script>
</body>

</html>