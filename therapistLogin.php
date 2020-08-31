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
        $sql = "select * from therapist where email='$email'"; //does this account exist?
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        if ($result->num_rows > 0) { //over 1 database(record) so run
            while ($row = $result->fetch_assoc()) {
                //display result
                $id = $row['therapist_id']; //[] inside is follow database 
                $passwordHash = $row['password'];
            }
            if (password_verify($password, $passwordHash)) {
                $_SESSION['thera_id'] = $id;

                echo '<script>window.location.assign("theraProfile.php")</script>';
            } else {
                echo '<script>window.alert("Wrong password...!")</script>';
            }
        }
        echo '<script>window.alert("No Account Available...!")</script>';
    } else {
        echo '<script>window.alert("Please fill in the email and password...!")</script>';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/therapistProfile.css">
</head>

<!-- registration area -->

<body>
    <section id="theraLogin-form">

        <div class="container">
            <div class="row m-0">
                <div class="col-lg-4 offset-lg-4">
                    <div class="text-center pb-5">
                        <h1 class="login-title">Therapist Login</h1>
                    </div>
                    <div class="upload-profile-image d-flex justify-content-center pb-4">
                        <div class="text-center">
                            <img src="images/profile/avatar.png" style="width: 200px; height: 200px" class="img rounded-circle" alt="profile">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form action="therapistLogin.php" method="POST" enctype="multipart/form-data" id="theralog-form">

                            <div class="form-row my-4">
                                <div class="col">
                                    <h4>Email</h4>
                                    <input type="email" required name="email" id="email" class="form-control" value="<?php if (isset($_POST['login'])) echo $_POST['email'] ?>">
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </section>
</body>

</html>