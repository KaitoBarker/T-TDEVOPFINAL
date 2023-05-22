<?php
// Database configuration
$dbHost     = 'localhost';
$dbUsername = 'your_username';
$dbPassword = 'your_password';
$dbName     = 'file_manager';

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file details from the database
    $sql    = "SELECT name, file_path FROM files WHERE id = $fileId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row       = $result->fetch_assoc();
        $fileName  = $row['name'];
        $filePath  = $row['file_path'];
        $fullPath  = __DIR__ . '/' . $filePath;

        if (file_exists($fullPath)) {
            // Send file for download
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Length: " . filesize($fullPath));

            readfile($fullPath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "File not found.";
    }
}

$conn->close();
?>
