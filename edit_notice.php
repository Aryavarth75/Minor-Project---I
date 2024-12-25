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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noticeId = $_POST['id'];
    $newTitle = htmlspecialchars($_POST['noticeTitle']);
    
    // Fetch existing file path from database
    $sql = "SELECT file_path FROM notices WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $noticeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $notice = $result->fetch_assoc();
    $stmt->close();
    
    // Check if a new file is uploaded
    if (!empty($_FILES["pdfFile"]["name"])) {
        $targetDir = "uploads/";
        $newFileName = basename($_FILES["pdfFile"]["name"]);
        $newFilePath = $targetDir . $newFileName;

        // Move new file and delete old one if it exists
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $newFilePath)) {
            if (file_exists($notice['file_path'])) {
                unlink($notice['file_path']); // Delete old file
            }
            $filePath = $newFilePath;
        } else {
            echo "Error uploading file.";
            exit;
        }
    } else {
        $filePath = $notice['file_path']; // Keep old file if no new file uploaded
    }

    // Update the database with the new title and file path
    $sql = "UPDATE notices SET title = ?, file_path = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $newTitle, $filePath, $noticeId);

    if ($stmt->execute()) {
        echo "Notice updated successfully.";
    } else {
        echo "Error updating notice: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
