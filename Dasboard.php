<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/dasstyle.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$con = new mysqli("localhost", "root", "", "student");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$email = $_SESSION['email'];
$stmt = $con->prepare("SELECT * FROM info WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();
$con->close();
?>
    <header>
        <div class="header">
        <p class="ph1"> <?php echo htmlspecialchars($student['first_name']); ?> welcome to UIT RGPV JHABUA</p>

        
    </div>
    <div class="contain">
      <din class="profile">

      </din>
      <div class="list">
        <li><a href="Editprofile.php
        ">Update profile</a></li>
        <li><a>Attendance</a></li>
        <li><a>Reports</a></li>
        <li><a>Documents</a></li>
        <li><a>Placement</a></li>
        <li><a>Performmance</a></li>
        <li><a>Campus Activity</a></li>
      </div>
      <div class="body"></div>
    </div>
    </header>

</body>
</html>