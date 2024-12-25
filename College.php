<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College</title>
    <link rel="stylesheet" href="css/college.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
     integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

// Fetch notices from the database
$sql = "SELECT title, file_path FROM notices ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

  <header>
    <div class="top">
      <div class="calltop">
        <i class="fa-solid fa-phone" style="color: #ffffff;"></i><p>+91-0739-2244216</p>
    </div>
    <div class="mailtop"><i class="fa-regular fa-envelope fa-xl" style="color: #ffffff;"></i><a href="mailto:uit0887@gmail.com">uit0887@gmail.com</a></i> </div>
    </div>
  </header> 
    <div class="contain">
      <div class="nav"> 
        <ul class="ulnav">
        <li><a href="College.html" class="anav" ><i class="fa-solid fa-house"></i>Home</a></li>
        <li>
          <a href="#" class="anav"><i class="fa-solid fa-graduation-cap"></i>Admission<i class="fa-solid fa-caret-down"></i></a>
          <div class="dropmanuadmission">
            <ul class="ulsub1">
              <li><a class="asub1">JEEMains</a></li>
              <li><a class="asub1">12th</a></li>
              <li><a class="asub1">LeteralEntry</a></li>
            </ul>
          </div>
        </li>
        <li><a class="anav"><i class="fa-solid fa-building-user"></i>Department<i class="fa-solid fa-caret-down"></i></a>
          <div class="dropmanudepartment">
            <ul>
              <li><a><i class="fa-solid fa-computer"></i>ComputerScience</a></li>
              <li><a><i class="fa-solid fa-gears"></i>MechanicleEngineering</a></li>
              <li><a><i class="fa-solid fa-bolt"></i>ElectricalEngineering</a></li>
              <li><a><i class="fa-solid fa-trowel"></i>CivilEngineering</a></li>
            </ul>

          </div>
        </li>
        <li>
          <a href="#"class="anav" ><i class="fa-solid fa-building-columns"></i>Acadmic's<i class="fa-solid fa-caret-down"></i></a>
             <div class="dropmanuacadmic">
               <ul class="ulsub2">
                 <li><a  class="asub1" href="login.php"><i class="fa-solid fa-user-graduate fa-lg"></i>Student login</a></li>
                 <li><a class="asub1" href="Faculty profile.html"><i class="fa-solid fa-person-chalkboard fa-lg"></i></i>Faculty Profile</a></li>
                 <li><a class="asub1" href="Gallery.html"><i class="fa-solid fa-image fa-lg"></i>Gallery</a></li>
                 <li><a class="asub1" href="IIC.html"><i class="fa-solid fa-screwdriver-wrench fa-lg"></i>IIC</a></li>
               </ul>
             </div>
            </li>
        <li><a href="Library.html" class="anav" ><i class="fa-solid fa-book-open-reader"></i>Library</a> </li>
        <li><a href="Contact.html" class="anav" ><i class="fa-solid fa-phone"></i>Contact</a> </li>
       </ul>
      </div>
    <div class="con">
       <div class="rgpv"> <img src="css/Photo/rgpv.png" alt="Girl in a jacket" width="100px" height="100px" id="contil"></div>
       <div class="cname">
        <div class="name">Welcome to</div>
        <div class="name">Dr. A.P.J. Abdul Kalam UIT Jhabua</div>
       </div>
      </div>
      <div class="sidenav">
        <div class="div1" href=""><a href="mailto:uit0887@gmail.com"> <img src="css/Photo/gmail.png"  > </a></div>
        <div class="div2" > <a href="https://www.instagram.com/uitrgpvjhabua?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><img src="css/Photo/instagram.png" ></a></div>
        <div class="div3"> <div class="div3no"><a>+91-0739-2244216</a></div></div>
      </div>
    </div>
    <div class="ms">
      <p id="p1">Principal UIT Jhabua</p>
      <p id="p2">Dr. Umesh Banodha</p>
    <div class="deen">
      
      <img src="css/Photo/principal.png" alt="Girl in a jacket" id="principal">
    </div></div>
    <div class="Activity"> 
    <div class="acty">
        <p id="Actp1">Notice Board</p>
        <div class="notice">
        <?php
        if ($result->num_rows > 0) {
            // Output each notice
            while($row = $result->fetch_assoc()) {
                echo "<p class='Act2'><a href='" . $row["file_path"] . "'>" . $row["title"] . "</a></p>";
            }
        } else {
            echo "<p class='Act2'>No notices available.</p>";
        }
        ?>
       </div>
    </div>
</div>
    <div class="footer">
      <img src="css/Photo/rgpv.png" alt="" id="rgpvfooter">
      <p id="footername">University Institute of Technology Jhabua
        <br>A contituent college of RGPV Bhopal
      </p>
      <div class="line"></div>
      <div class="footerimg"></div>
    </div>
   



<?php
$conn->close();
?>
</body>
</html>