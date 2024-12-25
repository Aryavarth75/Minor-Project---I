<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/Register1.css">
</head>
<body>
<header>
    <div class="top">
      <div class="calltop">
        <i class="fa-solid fa-phone" style="color: #ffffff;"></i><p>+91-0739-2244216</p>
    </div>
    <div class="mailtop"><i class="fa-regular fa-envelope fa-xl" style="color: #ffffff;"></i><a href="mailto:uit0887@gmail.com">uit0887@gmail.com</a></i> </div>
    </div>
  </header> 
    <div class="contain">
        <div class="box">
            
            <form method="post" action="register1.php">
                <div class="boxnav">
                <p>Enter enrollment no.</p><input type="text" name="Enroll" required/>
                </div>
                <div class="subbot"><input type="submit" name="submit" value="Search"/></div>
            </form>
        
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $enroll= $_POST['Enroll'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "student";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $stmt = $conn->prepare("SELECT * FROM enrollment WHERE enroll = ?");
        $stmt->bind_param("s", $enroll);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
         if ($enroll === $user['enroll']) {

            $_SESSION['enroll'] = $enroll;
            header('Location: register.php');
        } 
        else {
            $_SESSION['error'] = "User not found";
            header('Location: register1.php');
        }
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
