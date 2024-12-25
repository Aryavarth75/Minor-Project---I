<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Editprofile.css">
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];

    // Update customer details
    $update_stmt = $con->prepare("UPDATE info SET first_name = ?, last_name = ?, gender = ? WHERE email = ?");
    $update_stmt->bind_param("ssss", $first_name, $last_name, $gender, $email);

    if ($update_stmt->execute()) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $con->error;
    }

    

    $update_stmt->close();
    $stmt->close();
    $con->close();
    
    header('Location: Dasboard.php'); // redirect to the dashboard after update
    exit();
}

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
        <li><a>Update profile</a></li>
        <li><a>Attendance</a></li>
        <li><a>Reports</a></li>
        <li><a>Documents</a></li>
        <li><a>Placement</a></li>
        <li><a>Performmance</a></li>
        <li><a>Campus Activity</a></li>
      </div>
      <div class="body">
      <h2>Update Your Details</h2>
            <div class="input">
            <form method="POST" action="">
                <label for="first_name">First Name:</label><br>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
                <br>
                <label for="last_name">Last name:</label><br>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
                <br>
                <label for="gender">Gender:</label><br>
                <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($student['gender']); ?>" required>
                <br>
             
                <div class="update"><input type="submit" value="Update"></div>
            </form>
            </div>
      </div>
    </div>
    </header>

</body>
</html>