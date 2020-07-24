<?php
$servername = "localhost";//localhost for local PC or use IP address
$username = "root"; //database name
$password = "";//database password
$database = "register_db";//database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password,$database);

// define constant variables
define('DB_NAME', 'register_db');
define('DB_USER', 'root');
define('DB_PASSWORD', 'admin');
define('DB_HOST', 'localhost');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
        $default = "beard.png";
    
        // get the filename
        $filename = basename($file['name']);
        $targetFilePath = $targetDir . $filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
        If(!empty($filename)){
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
    
    
    // get user info
    function get_user_info($con, $userID){
        $query = "SELECT firstName, lastName, email, profileImage FROM user WHERE userID=?";
        $q = mysqli_stmt_init($con);
    
        mysqli_stmt_prepare($q, $query);
    
        // bind the statement
        mysqli_stmt_bind_param($q, 'i', $userID);
    
        // execute sql statement
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);
    
        $row = mysqli_fetch_array($result);
        return empty($row) ? false : $row;
    }
    
    $error = array();

$firstName = validate_input_text($_POST['firstName']);
if (empty($firstName)){
    $error[] = "You forgot to enter your first Name";
}

$lastName = validate_input_text($_POST['LastName']);
if (empty($lastName)){
    $error[] = "You forgot to enter your Last Name";
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
$profileImage = upload_profile('./assets/profile/', $files);

if(empty($error)){
    // register a new user
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    require ('mysqli_connect.php');

    // make a query
    $query = "INSERT INTO user (userID, firstName, lastName, email, password, profileImage, registerDate )";
    $query .= "VALUES(' ', ?, ?, ?, ?, ?, NOW())";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'sssss', $firstName, $lastName, $email, $hashed_pass, $profileImage);

    // execute statement
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){

        // start a new session
        session_start();

        // create session variable
        $_SESSION['userID'] = mysqli_insert_id($con);

        header('location: login.php');
        exit();
    }else{
        print "Error while registration...!";
    }

}else{
    echo 'not validate';
}




}
?>
<!doctype html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">

    
    <title>Client Register</title>

    <style>
     @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');

:root{
    --font-ubuntu: 'Ubuntu', monospace;
    --color-border: #e5e5e5;
}

.font-ubuntu{
    font: normal 500 16px var(--font-ubuntu);
}

#register, #login-form {
    padding: 5% 0;
    background: url("assets/background.png") no-repeat;
    background-size: cover;
}

#login-form{
    padding: 10% 0;
}

#register .upload-profile-image{
    position: relative;
    width: 10%;
    margin-left: auto;
    margin-right: auto;
    transition: filter .8s ease;
}

#register .upload-profile-image:hover{
    filter: drop-shadow(1px 1px 22px #7584bb);
}

#upload-profile{
    position: absolute;
    top: 0;
    z-index: 10;
    width: 200px;
    margin-top: 0px;
    opacity: 0;
}

#upload-profile::-webkit-file-upload-button{
    visibility: hidden;
}

#upload-profile::before{
    content: ' ';
    display: inline-block;
    width: 200px;
    height: 200px;
    cursor: pointer;
    border-radius: 50%;
}

#register .upload-profile-image .camera-icon{
    position: absolute;
    top: 70px;
    width: 60px !important;
    filter: invert(30%) !important;
}

#register .upload-profile-image:hover .camera-icon{
    filter: invert(100%) !important;
}

#reg-form input[type='text'],
#reg-form input[type='email'],
#reg-form input[type='password'],
#log-form input[type='text'],
#log-form input[type='email'],
#log-form input[type='password']{
    border: none;
    border-radius: unset;
    border-bottom: 1px solid var(--color-border);
    font-family: var(--font-ubuntu);
}
     }

 </style>
    
  </head>
  <header>
<?php require_once ("header1.php"); ?>
</header>
  
  <body>
  <!-- registration area -->
  <section id="register">
        <div class="row m-0">
            <div class="col-lg-4 offset-lg-2">
                <div class="text-center pb-5">
                    <h1 class="login-title text-dark">Register</h1>
                    <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
                    <span class="font-ubuntu text-black-50">I already have <a href="login.php">Login</a></span>
                </div>
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                        <div class="d-flex justify-content-center">
                            <img class="camera-icon" src="./assets/camera-solid.svg" alt="camera">
                        </div>
                        <img src="./assets/profile/beard.png" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                        <small class="form-text text-black-50">Choose Image</small>
                        <input type="file" form="reg-form" class="form-control-file" name="profileUpload" id="upload-profile">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName'];  ?>" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['LastName'])) echo $_POST['LastName'];  ?>" name="LastName" id="LastName" class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>" required name="email" id="email" class="form-control" placeholder="Email*">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="password" required name="password" id="password" class="form-control" placeholder="password*">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirm Password*">
                                <small id="confirm_error" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="agreement" class="form-check-input" required>
                            <label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term, conditions, and policy </a>(*) </label>
                        </div>

                        <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- #registration area -->
  <!-- Optional JavaScript -->
              <!-- jQuery first, then Popper.js, then Bootstrap JS -->
              <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <footer>
  <?php require_once ("footer.php");?>

</footer>
</html>