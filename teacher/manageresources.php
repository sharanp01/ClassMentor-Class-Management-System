<?php
include('components/connect.php');
include('components/sidebar.php');
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
    <style>
        /* before adding the img to the div with the 
"card-img" class, remove css styles 
.card-img .img::before and .card-img .img::after,
then set the desired styles for .card-img. */
        .card {
            --font-color: #323232;
            --font-color-sub: #666;
            --bg-color: #fff;
            --main-color: #323232;
            --main-focus: #2d8cf0;
            width: 230px;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            box-shadow: 4px 4px var(--main-color);
            border-radius: 5px;
            display: inline-block;
            margin-left: 20px;
            margin-top: 30px;
            /* flex-direction: column;
            justify-content: flex-start; */
            padding: 20px;
            gap: 10px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .card:last-child {
            justify-content: flex-end;
        }

        .card-img {
            /* clear and add new css */
            transition: all 0.5s;
            display: flex;
            justify-content: center;
        }

        .card-img .img {

            transform: scale(1);
            position: relative;
            box-sizing: border-box;
            width: 80px;
            height: 80px;
            border-top-left-radius: 80px 50px;
            border-top-right-radius: 80px 50px;
            border: 2px solid black;
            background-color: #228b22;
            background-image: linear-gradient(to top, transparent 10px, rgba(0, 0, 0, 0.3) 10px, rgba(0, 0, 0, 0.3) 13px, transparent 13px);
        }

        .card-title {
            font-size: 20px;
            font-weight: 500;
            text-align: center;
            color: var(--font-color);
        }

        .card-subtitle {
            font-size: 14px;
            font-weight: 400;
            color: var(--font-color-sub);
            margin-top: 5px;
        }

        .card-divider {
            width: 100%;
            border: 1px solid var(--main-color);
            border-radius: 50px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .card-footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        /*      .card-price {
            font-size: 20px;
            font-weight: 500;
            color: var(--font-color);
        } */

        /*    .card-price span {
            font-size: 20px;
            font-weight: 500;
            color: var(--font-color-sub);
        } */

        .card-btn {
            --bg: #000;
            --hover-text: #000;
            color: #fff;
            cursor: pointer;
            height: 35px;
            background: var(--bg);
            border: 2px solid var(--bg);
            border-radius: 5px;
            padding: 0 15px;
            transition: all 0.3s;
            margin-right: 7px;
        }

        .card:hover {
            transform: translateY(-10px);
            transition: 0.3s all ease-in-out;
        }

        .card-btn:hover {
            color: var(--hover-text);
            transform: translate(-0.25rem, -0.25rem);
            background: lightgreen;
            box-shadow: 0.25rem 0.25rem var(--bg);
        }

        .card-btn:active {
            transform: translate(0);
            box-shadow: none;
        }

        icond {
            position: relative;
            left: 20px;
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
        <?php

        // Query to fetch uploaded files from the database
        $sql = "SELECT * FROM resourcedetails";
        $result = $conn->query($sql);

        // Display uploaded files
        if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                $fileName = $row["filename"];
                $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                // Check if the file extension is docx
                if (strtolower($fileExt) == 'docx') {
                    echo "<div class='card'>";
                    echo " <div class='card-img'><img src='images/smalldoc.png'/></div>";
                    echo "<div class='card-title'>" . $row['Resourcename'] . "</div>";
                    echo "<div class='card-subtitle'>" . $row['Resourcedesc'] . "</div>";
                    echo " <hr class='card-divider'>";
                    echo "<div class='card-footer'>";
                    echo "<a href='" . $row["filepath"] . "' target='_blank'><button class='card-btn'>View</button></a>";
                    echo "<a href='download.php?file=" . urlencode($row["filename"]) . "'><button class='card-btn'>Download</button></a>";
                    echo " <td><a href='delete2.php?id=" . $row['ResourceID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt icond' ></i></a></td>";
                    echo "</div></div>";
                    $i++;
                }
                if (strtolower($fileExt) == 'pdf') {
                    echo "<div class='card'>";
                    echo " <div class='card-img'><img src='images/smallpdf.png'/></div>";
                    echo "<div class='card-title'>" . $row['Resourcename'] . "</div>";
                    echo "<div class='card-subtitle'>" . $row['Resourcedesc'] . "</div>";
                    echo " <hr class='card-divider'>";
                    echo "<div class='card-footer'>";
                    echo "<a href='" . $row["filepath"] . "' target='_blank'><button class='card-btn'>View</button></a>";
                    echo "<a href='download.php?file=" . urlencode($row["filename"]) . "'><button class='card-btn'>Download</button></a>";
                    echo " <td><a href='delete2.php?id=" . $row['ResourceID'] . "' id='btn' class='deletetext2'> <i class='fas fa-trash-alt icond' ></i></a></td>";
                    echo "</div></div>";
                    $i++;
                }
            }
        } else {
            echo "No files uploaded yet.";
        }

        // Close connection
        $conn->close();
        ?>
    </section>
</body>

</html>