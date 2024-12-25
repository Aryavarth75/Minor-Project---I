<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/Llogin.css">
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
            <p>Login</p>
            <form method="post" action="login.php">
                <div class="boxnav">
                    <ul>
                        <li class="borli"><p>Enter Email:</p><input type="email" name="Email" required/></li>
                        <li class="borli"><p>Enter Password:</p><input type="password" name="Password" required/></li>
                    </ul>
                </div>
                <div class="subbot"><input type="submit" name="submit" value="Login"/></div>
            </form>
            <div class="create"><a href="register1.php">Create/Register</a></div>
        </div>
    </div>
    <?php
    session_start();
    if (isset($_POST['submit'])) {
        $email = $_POST['Email']; 
        $password = $_POST['Password'];

        $con = new mysqli("localhost", "root", "", "student");

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $stmt = $con->prepare("SELECT * FROM info WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                header('Location: Dasboard.php');
            } else {
                $_SESSION['error'] = "Invalid password";
                header('Location: login.php');
            }
        } else {
            $_SESSION['error'] = "User not found";
            header('Location: register.php');
        }

        $stmt->close();
        $con->close();
    }
    ?>
</body>
</html>
