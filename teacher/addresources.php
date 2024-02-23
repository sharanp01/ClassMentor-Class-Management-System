<?php
include("components/connect.php");
include('components/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sidebarstyle.css">
    <link rel="stylesheet" href="styles/tablestyle.css">
    <link rel="stylesheet" href="styles/resstyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
            <h1 class="heading-text">Resources/Add Resources</h1>
            <form action="" method="post" enctype="multipart/form-data" id="myForm">
                <div class="resinput">
                    <label for="">Enter Resource Name:</label><br>
                    <input type="text" name="resname" id="resname" class="resname" required><br>
                </div>
                <div class="resinput">
                    <label for="">Enter Resource Description:</label> <br>
                    <textarea name="resdesc" id="" cols="60" rows="3" required></textarea><br>
                </div>
                <div class="resinput"> <label for="fileToUpload">Add Resource File</label><br>
                    <input type="file" name="fileToUpload" id="fileToUpload" required><br>
                </div>

                <div class="btndiv centerdiv">
                    <button type="submit" name="submit" id="button" class="button" onclick="clearForm()">Upload Resource</button>
                    <?php
                    if (isset($_POST["submit"])) {
                        $resname = $_POST['resname'];
                        $resdesc = $_POST['resdesc'];
                        $targetDir = "uploads/";
                        $fileName = basename($_FILES["fileToUpload"]["name"]);


                        $targetFilePath = $targetDir . $fileName;
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {

                            $sql = "INSERT INTO resourcedetails (Resourcename,Resourcedesc,filename ,filepath) VALUES ('$resname','$resdesc','$fileName', '$targetFilePath')";
                            if ($conn->query($sql) === TRUE) {
                                echo "<div class='successmsg'>
                    <label class='successtext'>Resource File Added</label>
        </div>";
                            } else {
                                $flag = 0;
                                echo "<div class='successmsg'>
                                <label class='successtext'>Resource File wasnt Added</label>
                    </div>";
                            }
                        } else {
                            echo "<div class='successmsg'>
                            <label class='successtext'>Resource File Uploaded Already, Please Add a new File to Upload</label>
                </div>";
                        }
                    }

                    ?>
                </div>
            </form>
        </div>
    </section>
    <script>
        window.onload = function() {
  // Get the form element
  var form = document.getElementById("myForm");
  // Reset the form
  form.reset();
};
    </script>

</body>

</html>