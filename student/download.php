<?php
// Check if the file parameter is set
if (isset($_GET["file"])) {
    // Get the filename from the query parameter
    $filename = $_GET["file"];

    // Define the path to the file directory
    $fileDir = "uploads/";

    // Define the full path to the file
    $filePath = $fileDir . $filename;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set appropriate headers for file download
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        // Read the file and output its contents
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
