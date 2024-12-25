<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register2.css">
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
            <p>Registration</p>
            <form method="post" action="register.php">
                <div class="boxnav">
                    <ul>
                        <li class="borli"><p>Enrollment no.:</p><input type="text" name="Enroll" required/></li>
                        <li class="borli"><p>First name:</p><input type="text" name="Firstname" required/></li>
                        <li class="borli"><p>Last name:</p><input type="text" name="Lastname" required/></li>
                        <li class="borli"><p>Email:</p><input type="email" name="Email" required/></li>
                        <li class="borli"><p>Password:</p><input type="password" name="Password" required/></li>
                        <li class="borli"><p>Gender:</p>
                    <div class="gender">
                        <input type="radio" id="check" name="Gender">
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check" name="Gender">
                        <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check" name="Gender">
                        <label for="check-other">Other</label>
                    </div>
          </li>
                    </ul>
                </div>
                <div class="subbot"><input type="submit" name="submit" value="Register"/></div>
            </form>
            <div class="create"><a href="login.php">Login</a></div>
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $enroll= $_POST['Enroll'];
        $n1 = $_POST['Firstname'];
        $n2 = $_POST['Lastname'];
        $n3 = $_POST['Email'];
        $n4 = password_hash($_POST['Password'], PASSWORD_BCRYPT); // Hash the password
        $n5 = $_POST['Gender'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "student";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO info (enrol_no,first_name, last_name, email, password, gender) VALUES (?,?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss",$enroll, $n1, $n2, $n3, $n4, $n5);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header('login.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
