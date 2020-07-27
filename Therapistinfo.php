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


session_start();

if(isset($_POST['logout'])){

    session_destroy();
    header('location:Home.php');
  }
?>
<!doctype html>
<html lang="en">
<title>therapistInformation</title>
<?php require_once ("header1.php"); ?>
<head>

</head>
<body>
<section id="info">
<br />
<div class="video-part">
 <video autoplay="autoplay" loop="loop" muted="muted">
  <source src="http://lightofweb.com/zanzo-website/video/Typing.mp4" type="video/mp4">
</video> 

<div class="container">
<div class="video-part-content">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <div class="carousel-caption ">
      <center>
      <img src="http://lightofweb.com/zanzo-website/img/light-bulb.png" class="img-responsive animated fadeInDown">
      </center>
      <div class="full-width animated fadeInUp">
        <h1>Job Opportunity</h1>
        <p>Welcome Join Us </p>
<a href="TherapistRegister.php" class="btn btn-info">Start Application</a>
</div>
      </div>
    </div>
    
  </div>

  <!-- Controls -->
  
</div>
</div>
</div>

</div>

  <div class= "container">
  <div class="row">
    <div class="col-md-12">
      <h2><strong>Help Malaysians in need by being on this platform. </strong></h2>
      <p>You will be able to consult clients and do what you do best – caring, understanding, guiding them to 
          new ways of thinking, and teaching skills to manage the challenges that they face in their lives.
           Don’t worry about the rest – we do them for you.</p>
    </div>
</br>
    <div class="col-xs-12 col-md-6">
      <h3><strong>Why work with us? </strong></h3>
      <p><strong>*No overheads </strong></p>
      <p>You do not need to worry about meeting rent, utilities, or acquiring clients. 
          We work tirelessly to ensure that those who would like to consult with you are eager to begin 
          the therapy process. We also ensure that the infrastructure is maintained around the clock.
           All of this is done at no cost to you. Just sign in to your account, and begin doing therapy! </p>

      <p><strong>*Diversification of services</strong></p>
      <p>Many clients feel that they need to feel ‘right’ with the therapist in order for them to consider 
          any further sessions. Many of them also find face-to-face therapy to be too costly for them, 
          despite really needing the service.</p>
      <p>At here, you are able to reach out to clients who you wouldn’t otherwise be able to consult
           due to these reasons. You can also use your individualized therapist code to follow-up with 
           your clients that have discontinued face-to-face therapy, or to connect with those who are unable to 
           meet you due to distance. </p>
    </div>
    <div class="col-xs-12 col-md-6">
      <p><strong>*Flexibility </strong></p>
      <p>Here can be your main source of income, or as a supplement to your current work.
           You decide the amount of clients that you do therapy with here. 
           Most of the operations here are asynchronous, which means that you are able to log in daily 
           at your most convenient times of the day. You do not need to worry about anything else, other than 
           to perform the work that you love. </p>
      <h3><strong>Requirements </strong></h3>
      <p>• A minimum of a Master’s degree in Counseling, Counseling Psychology, or Clinical Psychology. </p>
      <p>• For counselors, a valid counseling license issued by Lembaga Kaunselor Malaysia. </p>
      <p>• To have undergone the required supervision and session hours based on the respective field’s requirements. </p>
      <p>• Experience in individual counseling for adults.</p>
      <p><strong>Note </strong>: Therapists on the platform are independent providers and are not this platform's employees.
       Please provide valid e-mail and phone number for further correspondence. </p>
    </div>
  </div>
</div>
<div>
  <form action="FAQ.php" method=POST>
    <input type="submit" value="Start Application" name="logout" style="margin-top:80px;margin-left:300px;">
    </form></div>
<br />
<br />
</div>

</body>
<footer>
  <?php require_once ("footer.php");?>

</footer>
</section>
</html>