<?php
// Database configuration
$host = 'localhost'; // Database host
$dbUsername = 'cl39-admin'; // Database username
$dbPassword = 'Dudley1179'; // Database password
$dbName = 'cl39-admin'; // Database name

// Create a database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform a database query (Example: Checking user credentials)
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        echo "Login successful!";
    } else {
        // Authentication failed
        echo "Invalid username or password. Please try again.";
    }
}

// Close the database connection
$conn->close();
?>