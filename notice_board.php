<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/notice.css">
    <title>College Notice Board</title>
    

</head>
<body>
<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle PDF upload and notice insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_notice'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["pdfFile"]["name"]);
    $filePath = $targetDir . $fileName;
    $noticeTitle = htmlspecialchars($_POST['noticeTitle']);

    // Check if uploads directory exists, if not, create it
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Validate file type
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    if ($fileType != "pdf") {
        echo "Only PDF files are allowed.";
    } else {
        // Move uploaded file
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $filePath)) {
            // Insert notice into database
            $stmt = $conn->prepare("INSERT INTO notices (title, file_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $noticeTitle, $filePath);
            if ($stmt->execute()) {
                echo "Notice uploaded successfully.";
            } else {
                echo "Error saving notice to database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    }
}

// Handle notice deletion
if (isset($_GET['delete_id'])) {
    $noticeId = $_GET['delete_id'];

    // Fetch the file path
    $sql = "SELECT file_path FROM notices WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $noticeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $notice = $result->fetch_assoc();
    $stmt->close();

    // Delete the record from the database
    $sql = "DELETE FROM notices WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $noticeId);

    if ($stmt->execute()) {
        // Delete the file from the server
        if (file_exists($notice['file_path'])) {
            unlink($notice['file_path']);
        }
        echo "Notice deleted successfully.";
    } else {
        echo "Error deleting notice: " . $stmt->error;
    }
    $stmt->close();
}
?>


    <h1>College Notice Board</h1>

    <!-- Form to add a new notice -->
    <form action="notice_board.php" method="post" enctype="multipart/form-data">
        <label for="noticeTitle">Notice Title:</label>
        <input type="text" name="noticeTitle" id="noticeTitle" required>
        
        <label for="pdfFile">Select PDF to upload:</label>
        <input type="file" name="pdfFile" id="pdfFile" accept="application/pdf" required>
        
        <input type="submit" name="upload_notice" value="Add Notice">
    </form>

    <h2>Notice Board</h2>
    <div class="Activity">
        <div class="acty">
            <p id="Actp1">Notice Board</p>
            <?php
            // Fetch and display notices
            $sql = "SELECT id, title, file_path FROM notices ORDER BY uploaded_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p class='Act2'><a href='" . $row["file_path"] . "'>" . $row["title"] . "</a>";
                    echo " | <a href='notice_board.php?delete_id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this notice?\")'>Delete</a></p>";
                }
            } else {
                echo "<p class='Act2'>No notices available.</p>";
            }
            ?>
        </div>
    </div>


<?php
$conn->close();
?>

</body>
</html>

