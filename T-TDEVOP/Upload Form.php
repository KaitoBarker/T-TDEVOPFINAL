<!DOCTYPE html>
<html>
<head>
    <title>File Upload and Download</title>
</head>
<body>
    <h1>File Upload and Download</h1>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <input type="submit" name="uploadBtn" value="Upload" />
    </form>

    <hr>

    <h2>Uploaded Files</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>File Name</th>
            <th>Action</th>
        </tr>

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

        // Fetch uploaded files from the database
        $sql    = "SELECT id, name FROM files";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fileId   = $row['id'];
                $fileName = $row['name'];

                echo "<tr>";
                echo "<td>$fileId</td>";
                echo "<td>$fileName</td>";
                echo "<td><a href='download.php?id=$fileId'>Download</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No files found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
