<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET["file"])) {
   
    $filename = $_GET["file"];

    
    $fileDir = "uploads/";

   
    $filePath = $fileDir . $filename;

  
    if (file_exists($filePath)) {
     
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
     
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
