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

if (isset($_POST['uploadBtn']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['file']['name'];
    $fileTmp  = $_FILES['file']['tmp_name'];

    // Move the uploaded file to a directory
    $uploadDir  = 'uploads/';
    $uploadPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $uploadPath)) {
        // Insert file details into the database
        $sql = "INSERT INTO files (name, file_path) VALUES ('$fileName', '$uploadPath')";
        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "File upload failed.";
    }
}

$conn->close();
?>
