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


mysqli_set_charset($conn, 'utf8');


//check the pathinfo and upload the file
function upload_profile($path, $file)
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
    }
    // return default image
    return $path . $default;
}

session_start();

//prevent injection
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

//prevent injection
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



if (isset($_POST['submit'])) { //if user register an account
    // error variable.
    $error = array();

    $birth = $_POST['birth'];

    $firstname = validate_input_text($_POST['firstname']);
    if (empty($firstname)) {
        $error[] = "You forgot to enter your Name";
    }

    $lastname = validate_input_text($_POST['lastName']);
    if (empty($lastname)) {
        $error[] = "You forgot to enter your Name";
    }

    $email = validate_input_text($_POST['reEmail']);
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

    $city = validate_input_text($_POST['city']);
    if (empty($city)) {
        $error[] = "You forgot to enter your city";
    }

    $state = validate_input_text($_POST['state']);
    if (empty($state)) {
        $error[] = "You forgot to enter your state";
    }

    $postCode = validate_input_text($_POST['postCode']);
    if (empty($postCode)) {
        $error[] = "You forgot to enter your post code";
    }

    $password = validate_input_text($_POST['rePassword']);
    if (empty($password)) {
        $error[] = "You forgot to enter your password";
    }

    $confirm_pwd = validate_input_text($_POST['confirm_pwd']);
    if (empty($confirm_pwd)) {
        $error[] = "You forgot to enter your Confirm Password";
    }


    $files = $_FILES['profileUpload'];
    $profileImage = upload_profile('./images/profile/', $files);


    if (empty($error) && ($password == $confirm_pwd)) {
        $generateid = uniqid();
        // register a new user
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $sqli = "Select * from client where email='$email'"; //username and password same ？
        $result1 = mysqli_query($conn, $sqli) or die($conn->error . __LINE__); //sql

        $count = mysqli_num_rows($result1);

        if ($count == 0) {
            $sql = "insert into client values('$generateid','$firstname','$lastname','$birth','$phone','$address','$city','$postCode','$state','$email','$hashed_pass','$profileImage',NOW())";
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result == true) {
                echo '<style type="text/css"> 
            .register-success{
                display:block !important;            
            }</style>';
            }
        } else {
            echo '<style type="text/css"> 
            .already-registered{
                display:block !important;            
            }</style>';
        }
    } else {
        echo '<style type="text/css"> 
        .password-notmatch{
                display:block !important;            
            }</style>';
    }
}



if (isset($_POST['login'])) { //if user login
    $error = array();

    $email = validate_input_email($_POST['email']);
    if (empty($email)) {
        $error[] = "You forgot to enter your Email";
    }

    $password = validate_input_text($_POST['password']);
    if (empty($password)) {
        $error[] = "You forgot to enter your password";
    }


    if (empty($error)) {
        // sql query
        $sql = "select * from client where email='$email'"; //username and password same ？
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        if ($result->num_rows > 0) { //over 1 database(record) so run
            while ($row = $result->fetch_assoc()) {
                //display result
                $id = $row['id']; //[] inside is follow database 
                $passwordHash = $row['password'];
            }
            if (password_verify($password, $passwordHash)) {
                $_SESSION['id'] = $id;
                echo '<script>window.location.assign("Home.php");</script>';
                exit();
            } else {
                echo '<style type="text/css"> 
            .wrong-password{
                display:block !important;            
            }</style>';
            }
        } else {
            echo '<style type="text/css"> 
        .unavailable{
            display:block !important;            
        }</style>';
        }
    } else {
        echo '<style type="text/css"> 
    .error{
        display:block !important;            
    }</style>';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
    <?php require_once("header1.php"); ?>
</header>
<!-- registration area -->

<body>
    <section id="login-form">
        <div class="alert alert-success alert-dismissible fade show text-center register-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Register Successful!</strong> You can Login Now!
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center register-fail">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Register Fail, Please Try Again!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error while Login, Please Try Again!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center unavailable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Unavailable Email or Password, Please Try Again!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center wrong-password">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Wrong Password..!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center password-notmatch">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Password are not Match, Please Register Again! ..!</strong>
        </div>

        <div class="alert alert-danger alert-dismissible fade show text-center already-registered">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>This Email Has Already Registered, Please Use another Email...!</strong>
        </div>

        <div class="container">
            <div class="row m-0">
                <div class="col-lg-4 offset-lg-4">
                    <div class="text-center pb-5">
                        <h1 class="login-title">Login</h1>
                        <p class="p-1 m-0 font-ubuntu">Login and enjoy additional features</p>
                    </div>
                    <div class="upload-profile-image d-flex justify-content-center pb-4">
                        <div class="text-center">
                            <img src="images/profile/beard.png" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form action="login.php" method="post" enctype="multipart/form-data" id="log-form" class="needs-validation" novalidate>

                            <div class="form-row my-4">
                                <div class="col">
                                    <h4>Email</h4>
                                    <input type="email" required name="email" id="email" class="form-control" value="<?php if (isset($_POST['login'])) {
                                                                                                                            echo $_POST['email'];
                                                                                                                        } ?>">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="form-row my-4">
                                <div class="col">
                                    <h4>Password</h4>
                                    <input type="password" required name="password" id="password" class="form-control">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="form-row my-0">
                                <div class="col">
                                    <p>Forget your password? Click here <a href="#">Reset Password</a></p>
                                    <span class="text-black-100">Don't have account?</span> &nbsp;<button type="button" class="btn btn-white" data-toggle="modal" data-target="#registerModal" id="register"><strong>Register</strong></button>
                                </div>
                            </div>

                            <div class="submit-btn text-center my-3">
                                <input type="submit" name="login" value="submit">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() == false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
<?php include("modal.php") ?>

</html>
