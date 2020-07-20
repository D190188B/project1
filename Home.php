<?php
$servername = "localhost";//localhost for local PC or use IP address
$username = "root"; //database name
$password = "";//database password
$database = "oncoun";//database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password,$database);

// Check connection #scawx
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="project1.css">
    <title>Home</title>
</head>


<header>
<?php require_once ("header1.php"); ?>
</header>
  
<body>
<div class="content" >

    <div class="content-top" align="center">

      <img src="images/counselling.jpg">

    </div>

    
    <div class="arti">

        <div class="arti-contentWhole1">

            <div class="arti-contentLeft">
                <h2><strong>Our Therapists</strong></h2>
                <img src="images/therapist1.jpg">
                <img src="images/therapist2.jpg">
                <img src="images/therapist3.jpg">
            </div>

            <div class="arti-contentRight">
                <p>Counselors in BetterHelp are licensed, trained, experienced, and accredited psychologists (PhD / PsyD), marriage and family therapists (MFT), clinical social workers (LCSW), or licensed professional counselors (LPC). All of them have a Masters Degree or a Doctorate Degree in their field. They have been qualified and certified by their state professional board after successfully completing the necessary education, exams, training and practice. While their experience, expertise and background vary, they all possess at least 3 years and 1,000 hours of hands-on experience. <br></p>

                <button class="btn"><a href="#">Meet Our Therapists</a></button>
            </div>
          
        </div>


      <div class="arti-contentWhole2">

            <div class="arti-content1Left" >
              <h3><strong>Chat online with therapist
      
              </strong></h3>
          
              <img src="images/chat.jpg">

            </div>
      
            <div class="arti-content1Right">
                <p>Need to talk to someone? Our therapists are available to give emotional support over online chat.<br><br>
                <strong>It's anonymous and completely safe.</strong><br><br>
                When you need someone to talk to, we're here to listen and help you feel better.<br>
                </p>

                <button class="btn1"><a href="#">Make Appointment Now!</a></button>
            </div>
            

      </div>

      <div class="arti-contentWhole3">
        
            <div class="arti-content2Left">
            <h3><strong>Try self help made easy</strong></h3><br>
                <img src="images/depression.jpg">

            </div>

            <div class="arti-content2Right">

              <p>
                  <br>
                    Discover your personal growth path and learn new coping skills to grow stronger each day.<br><br>
                    Each step on your path is a simple self help activity, designed to help you feel better.<br>

                    <button class="btn2"><a href="#">Self Test</a></button>
              </p>
          
            </div>

      </div>

    </div>

</div>
    
</body>

<footer>
  <?php require_once ("footer.php");?>

</footer>


</html>

  