<?php
$servername = "localhost"; //localhost for local PC or use IP address
$username = "root"; //database name
$password = ""; //database password
$database = "oncoun"; //database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password, $database);

// Check connection #scawx
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


session_start();

function validate_input_text($textValue)
{
  if (!empty($textValue)) {
    $trim_text = trim($textValue);
    // remove illegal character
    $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
    return $sanitize_str;
  }
  return '';
}

function validate_input_email($emailValue)
{
  if (!empty($emailValue)) {
    $trim_text = trim($emailValue);
    // remove illegal character
    $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
    return $sanitize_str;
  }
  return '';
}

function upload_thera($path, $file)
{
  $targetDir = $path;
  $default = "beard.png";
  // get the filename
  $filename = basename($file['name']);
  $targetFilePath = $targetDir . $filename;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (!empty($filename)) {
    // allow certain file format
    $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowType)) {
      // upload file to the server
      if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return $targetFilePath;
      }
    }
  } else {
    // return default image
    return $path . $default;
  }
}

function upload_certificate($path, $file)
{
  $targetDir = $path;
  $default = "beard.png";
  // get the filename
  $filename = basename($file['name']);
  $targetFilePath = $targetDir . $filename;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (!empty($filename)) {
    // allow certain file format
    $allowType = array('docx', 'doc', 'pptx', 'pdf', 'jpg', 'png', 'jpeg');
    if (in_array($fileType, $allowType)) {
      // upload file to the server
      if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return $targetFilePath;
      }
    }
  } else {
    // return default image
    return '';
  }
}

if (isset($_POST['submit'])) {
  // error variable.
  $error = array();
  $license = $_POST['license'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];


  // $about = mysqli_real_escape_string($conn, $_POST['about']);

  $firstname = validate_input_text($_POST['firstname']);
  if (empty($firstname)) {
    $error[] = "You forgot to enter your Name";
  }

  $lastname = validate_input_text($_POST['lastName']);
  if (empty($lastname)) {
    $error[] = "You forgot to enter your Name";
  }

  $email = validate_input_email($_POST['email']);
  if (empty($email)) {
    $error[] = "You forgot to enter your Email";
  }

  $phone = validate_input_text($_POST['phone']);
  if (empty($phone)) {
    $error[] = "You forgot to enter your phone number";
  }

  $address = mysqli_real_escape_string($conn, $_POST['address']);
  if (empty($address)) {
    $error[] = "You forgot to enter your address";
  }

  $state = validate_input_text($_POST['state']);
  if (empty($state)) {
    $error[] = "You forgot to enter your phone state";
  }

  $postCode = validate_input_text($_POST['postCode']);
  if (empty($postCode)) {
    $error[] = "You forgot to enter your phone postCode";
  }

  $ic = mysqli_real_escape_string($conn, $_POST['ic']);
  if (empty($ic)) {
    $error[] = "You forgot to enter your ic";
  }

  $password = validate_input_text($_POST['password']);
  if (empty($password)) {
    $error[] = "You forgot to enter your password";
  }

  $confirm_pwd = validate_input_text($_POST['confirm_pwd']);
  if (empty($confirm_pwd)) {
    $error[] = "You forgot to enter your Confirm Password";
  }


  $file1 = $_FILES['certificate'];
  $fileCer = upload_certificate('./images/certificate/', $file1);

  $files = $_FILES['profileUpload'];
  $profileImage = upload_thera('./images/profile/', $files);



  if (empty($error) && ($password == $confirm_pwd) && (!empty($fileCer))) {
    $generateid = uniqid();
    // register a new user
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $sqli = "Select * from therapist where email='$email'"; //username and password same ？
    $result1 = mysqli_query($conn, $sqli) or die($conn->error.__LINE__); //sql

    $count = mysqli_num_rows($result1);

    if ($count == 0) {
      $sql = "insert into therapist values('$generateid','$firstname','$lastname','','$gender','$age','$email','$phone','$ic','$address','$state','$postCode','$license','$fileCer','$hashed_pass','$profileImage','1',NOW())";
      $result = $conn->query($sql);

      echo '<script>window.alert("Submit successful...!")</script>';
      // header('refresh:0.1; url=Home.php');
    } else {
      echo '<script>window.alert("This email has already registered...!")</script>';
    }
  } else {
    echo '<script>window.alert("Password or file are not match...!")</script>';
  }
}

?>
<!doctype html>
<html lang="en">
<title>therapistInformation</title>
<?php require_once("header1.php"); ?>

<head>
  <link rel="stylesheet" type="text/css" href="css/therapistRegister.css">
</head>


<section id="info">

  <body>
    <br />
    <form action="Therapistinfo.php" method="post" enctype="multipart/form-data" id="theraRegister">
      <div class="container" style="margin-top:-75px">
        <div class="video-part">

          <div class="container">
            <div class="video-part-content">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active" style="display:none;"></li>

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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TheraReg" title="Therapist Register" id="therapistRegister">Register as Therapist</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bot">
          <div class="container" style="margin-top:150px;">
            <div class="row">
              <div class="col-md-12" style="margin-left:7px;margin-bottom:10px;">
                <h2 style="margin-left:0px;"><strong>Help Malaysians in need by being on this platform. </strong></h2>
                <p>You will be able to consult clients and do what you do best – caring, understanding, guiding them to
                  new ways of thinking, and teaching skills to manage the challenges that they face in their lives.
                  Don’t worry about the rest – we do them for you.</p>
              </div>
              </br>
              <div class="col-xs-12 col-md-6" style="padding-left:20px;padding-right:10px;">
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
          <br />
          <br />
        </div>
      </div>
    </form>
  </body>

</section>
<footer>
  <?php require_once("footer.php"); ?>
</footer>
<?php include("therapistRegistercopy.php") ?>

</html>
