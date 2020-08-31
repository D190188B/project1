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

    $email = validate_input_text($_POST['email']);
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

    $password = validate_input_text($_POST['password']);
    if (empty($password)) {
        $error[] = "You forgot to enter your password";
    }

    $confirm_pwd = validate_input_text($_POST['confirm_pwd']);
    if (empty($confirm_pwd)) {
        $error[] = "You forgot to enter your Confirm Password";
    }


    $files = $_FILES['profileUpload'];
    $profileImage = upload_profile('./images/profile/', $files);


    if (empty($error) && ($password == $confirm_pwd)){
        $generateid = uniqid();
        // register a new user
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $sqli = "Select * from client where email='$email'"; //username and password same ？
        $result1 = mysqli_query($conn, $sqli) or die($conn->error.__LINE__); //sql

        $count = mysqli_num_rows($result1);

        if ($count == 0) {
            $sql = "insert into client values('$generateid','$firstname','$lastname','$birth','$phone','$address','$city','$postCode','$state','$email','$hashed_pass','$profileImage',NOW())";
            $result = $conn->query($sql) or die($conn->error.__LINE__);

            if ($result == true) {
                echo '<script>window.alert("Register successful...!")</script>';
            }
        } else {
            echo '<script>window.alert("This email has already registered...!")</script>';
        }
    } else {
        echo '<script>window.alert("Password is not match....!!!!")</script>';
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
        $result = $conn->query($sql) or die($conn->error.__LINE__);


        if ($result->num_rows > 0) { //over 1 database(record) so run
            while ($row = $result->fetch_assoc()) {
                //display result
                $id = $row['id']; //[] inside is follow database 
                $passwordHash = $row['password'];
            }
            if (password_verify($password, $passwordHash)) {
                $_SESSION['id'] = $id;
                header('refresh: 0; url=Home.php');
                exit();
            } else {
                echo '<script>window.alert("Unavariable name or password")</script>';
            }
        }
    } else {
        echo '<script>window.alert（"Please Fill out email and password to login!"）</script>';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <style>
    </style>
</head>
<header>
    <?php require_once("header1.php"); ?>
</header>
<!-- registration area -->

<body>
    <section id="login-form">

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
                        <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">

                            <div class="form-row my-4">
                                <div class="col">
                                    <h4>Email</h4>
                                    <input type="email" required name="email" id="email" class="form-control" value="<?php if(isset($_POST['login'])){echo $_POST['email'];} ?>">
                                </div>
                            </div>

                            <div class="form-row my-4">
                                <div class="col">
                                    <h4>Password</h4>
                                    <input type="password" required name="password" id="password" class="form-control">
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
</body>
<?php include("modal.php") ?>

</html>
