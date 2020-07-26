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
mysqli_set_charset($conn, 'utf8');

function validate_input_text($textValue){
    if (!empty($textValue)){
        $trim_text = trim($textValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
}

function validate_input_email($emailValue){
    if (!empty($emailValue)){
        $trim_text = trim($emailValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
        return $sanitize_str;
    }
    return '';
}

// profile image
function upload_profile($path, $file){
    $targetDir = $path;
    $default = "images/beard.png";

    // get the filename
    $filename = basename($file['name']);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if(!empty($filename)){
        // allow certain file format
        $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if(in_array($fileType, $allowType)){
            // upload file to the server
            if(move_uploaded_file($file['tmp_name'], $targetFilePath)){
                return $targetFilePath;
            }
        }
    }
    // return default image
    return $path . $default;
}


if(isset($_POST['submit'])){
// error variable.
$error = array();

$birth=$_POST['birth'];

$name = validate_input_text($_POST['name']);
if (empty($name)){
    $error[] = "You forgot to enter your Name";
}

$email = validate_input_email($_POST['email']);
if (empty($email)){
    $error[] = "You forgot to enter your Email";
}

$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "You forgot to enter your password";
}

$confirm_pwd = validate_input_text($_POST['confirm_pwd']);
if (empty($confirm_pwd)){
    $error[] = "You forgot to enter your Confirm Password";
}


$files = $_FILES['profileUpload'];
$profileImage = upload_profile('./images/profile/', $files);


if(empty($error)){
    $generateid = uniqid();
    // register a new user
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $sqli = "Select * from client where email='$email'";//username and password same ？
    $result1= mysqli_query($conn,$sqli);//sql

    $count = mysqli_num_rows($result1);

    if($count == 0){
    $sql="insert into client values('$generateid','$name','$birth','$email','$hashed_pass','$profileImage',NOW())";
    $result=$conn->query($sql);

    echo '<script>window.alert("Registration successful...!")</script>';
    header("location:Home.php");
    exit();

    }else{
        echo '<script>window.alert("This email has already registered...!")</script>';
    }
    }else{
    echo '<script>window.alert("Error while registration...!")</script>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>
</head>
<body>

<main id="main-area">
<header>
    <?php require_once ("header1.php"); ?>
</header>
               

    <!-- registration area -->
    <section id="register">
        <div class="row m-0">
            <div class="col-lg-4 offset-lg-4">
                <div class="text-center pb-5">
                    <h1 class="login-title text-dark">Register</h1>
                    <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
                    <span class="font-ubuntu text-black-50">I already have <a href="login.php">Login</a></span>
                </div>
                
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                        <div class="d-flex justify-content-center">
                            <img class="camera-icon" src="images/camera-solid.svg" alt="camera">
                        </div>
                        <img src="images/profile/beard.png" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                        <small class="form-text text-black-50">Choose Image</small>
                        <input type="file" form="reg-form" class="form-control-file" name="profileUpload" id="upload-profile">
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">

                        <div class="form-row my-0">
                            <div class="col">
                            <h4>Username</h4>
                                <input type="text" required name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-row my-4">
                            <div class="col">
                            <h4>Birthday</h4>
                                <input type="date" required name="birth" id="birth" class="form-control">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                            <h4>Email</h4>
                                <input type="email"  required name="email" id="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                            <h4>Password</h4>
                                <input type="password" required name="password" id="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                            <h4>Confirm Password</h4>
                                <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control">
                                <small id="confirm_error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="agreement" class="form-check-input" required>
                            <label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term, conditions, and policy </a>(*) </label>
                        </div>

                        <div class="submit-btn text-center my-5">
                            <input type="submit" value="Register" name="submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

</html>

