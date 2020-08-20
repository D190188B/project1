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

if (isset($_POST['logout'])) {

    session_destroy();
    header('location:Home.php');
}


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "select * from client where id ='$id'"; //id is database name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name_first'] = $row['name_first'];
            $_SESSION['name_last'] = $row['name_last'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['birth'] = $row['birth'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['state'] = $row['state'];
            $_SESSION['post_code'] = $row['post_code'];
            $_SESSION['profileImage'] = $row['profileImage'];
        }
    }
}


function upload_profile($path, $file)
{
    $targetDir = $path;
    $default = $_SESSION['profileImage'];

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
    return $default;
}

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


if (isset($_POST['submit'])) {

    $nameFirst = validate_input_text($_POST['nameFirst']);
    $nameLast = validate_input_text($_POST['nameLast']);
    $phone = validate_input_text($_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = validate_input_text($_POST['state']);
    $postCode = validate_input_text($_POST['postCode']);


    $files = $_FILES['uploadProfile'];
    $profileImage = upload_profile('./images/profile/', $files);

    
    $sql = "update client set name_first='$nameFirst',name_last='$nameLast',phone='$phone',address='$address',state='$state',post_code='$postCode',profileImage='$profileImage' where id='$id'";

    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) {
        $_SESSION['name_first'] = $_POST['nameFirst'];
        $_SESSION['name_last'] = $_POST['nameLast'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['post_code'] = $_POST['postCode'];
        $_SESSION['profileImage']= $profileImage;
    }
}

$email = $_SESSION['email'];

$sqli = "select * from appointment left join therapist on appointment.therapist_ID=therapist.therapist_id where user_Email='$email'";
$result = $conn->query($sqli) or die($conn->error . __LINE__);
?>





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        

        .side_left {
            margin-bottom: 30px;
        }

        button.info:focus {
            outline: none;
        }

        #showAppointment {
            display: none;
        }

        #showPayment {
            display: none;
        }

        button#logBtn {
            background-color: darkblue;
            border: none;
            padding: 0 10px 0 15px;
            margin: -2px 0 0 -20px;
            border-radius: 10px;
            color: white;
            transition: ease 0.5s;
        }

        button#logBtn:hover {
            background-color: rgba(59, 82, 114);
            transition: ease 0.5s;
        }

        .edit {
            margin: 20px 0 10px 0;
        }

        button#submit {
            display: none;
        }

        button#cancel {
            display: none;
        }

        #uploadProfile {
            position: absolute;
            top: -15px;
            left: 13px;
            z-index: 10;
            width: 200px;
            margin-top: 5px;
            opacity: 0;
            display:none;
        }

        #uploadProfile::before {
            content: ' ';
            display: inline-block;
            width: 200px;
            height: 170px;
            cursor: pointer;
            border-radius: 50%;
        }

        #uploadProfile::-webkit-file-upload-button {
            visibility: hidden;
        }

        #changePro{
            display:none;
            color:blue;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">

<?php require_once("header1.php") ?>

<body>



    <section id="profile_copy">
        <div class="container" style="margin-bottom:20px;margin-top:70px;">
            <div class="row">
                <div class="col-md-4" style="border:1px solid rgb(223, 223, 223)">
                    <div class="col-md-12">
                        <h2 style="margin:20px 0 0 20px;"><strong>User Profile</strong></h2>
                    </div>

                    <div class="col-md-12 side_left" style="margin-top:80px;">
                        <div class="row">
                            <i class="fa fa-user-o" aria-hidden="true" style="font-size:28px;" id="userIcon"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="infoBtn" id="infoBtn" style="background-color:white;border:none;margin-top:-2px;padding:none;color:black" onclick="show1()">
                                <h4 id="user" style="border-bottom:1px solid black;border-radius:1px;">User Info</h4>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-12 side_left">
                        <div class="row">
                            <i class="fa fa-file-text-o" aria-hidden="true" style="font-size:28px;color:silver" id="userAppointment"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="appointmentBtn" id="appointmentBtn" style="background-color:white;border:none;padding:none;margin-top:-2px;color:silver" onclick="show2()">
                                <h4 id="appointment">Appointment History</h4>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-12 side_left">
                        <div class="row">
                            <i class="fa fa-money" aria-hidden="true" style="font-size:28px;color:silver" id="userPayment"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="paymenBtn" id="paymenBtn" style="background-color:white;border:none;padding:none;margin-top:-2px;color:silver" onclick="show3()">
                                <h4 id="payment">Your Payment</h4>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 434px;">
                        <div class="row">

                            &nbsp;
                            &nbsp;
                            <form action="profileCopy.php" method="POST" id="save" enctype="multipart/form-data">
                                <button class="info" form="save" type="submit" name="logout" id="logBtn" onclick="return confirm('Are you sure you want to log out?')" style="padding:7px;">
                                    <i class="fa fa-sign-out" aria-hidden="true" style="font-size: 23px;padding-top: 3px;float:left"></i>
                                    <h5 id="logOut" style="float:left;padding-left:5px;">Log out</h5>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-8" style="border:1px solid rgb(223, 223, 223)">
                    <div class="col-md-12" id="showInfo" name="showInfo">

                        <div class="row" style="margin:30px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img src="<?php echo $_SESSION['profileImage'] ?>" class="img" style="width:150px;height:150px;border-radius:50%;border:1px solid black" name="user_image" id="user_image">
                                        <input type="file" name="uploadProfile" id="uploadProfile" form="save" class="form-control-file">
                                        <h6 style="margin-top:20px;" id="changePro">Change profile photo</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <h4 style="color:black;margin-top:30px;"><?php echo $_SESSION['name_first'] . "&nbsp;" . $_SESSION['name_last'] ?></h4>
                                        <h5 style="color: rgb(160, 160, 160);margin-top:20px;"><?php echo $_SESSION['state'] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-left:30px">

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">First Name</h5>
                                <input type="text" name="nameFirst" id="nameFirst" value="<?php echo $_SESSION['name_first'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">Last Name</h5>
                                <input type="text" name="nameLast" id="nameLast" value="<?php echo $_SESSION['name_last'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px;">
                                <h5 style="color:black">Email</h5>
                                <input type="text" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px;">
                                <h5 style="color:black">Phone Number</h5>
                                <input type="text" name="phone" id="phone" value="<?php echo $_SESSION['phone'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-12" style="margin:20px 0 10px 0;">
                                <h5 style="color:black">Address</h5>
                                <input type="text" name="address" id="address" value="<?php echo $_SESSION['address'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:82%;" readonly>
                            </div>

                            <div class="col-md-6" style="margin:20px 0 10px 0;">
                                <h5 style="color:black">State</h5>
                                <input type="text" name="state" id="state" value="<?php echo $_SESSION['state'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin:20px 0 10px 0;">
                                <h5 style="color:black">Post Code</h5>
                                <input type="text" name="postCode" id="postCode" value="<?php echo $_SESSION['post_code'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>


                            <div class="col-md-6" style="margin:20px 0 10px 0;">
                                <h5 style="color:black">Birth</h5>
                                <input type="text" name="birth" id="birth" value="<?php echo $_SESSION['birth'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-12 edit" id="editPlace">
                                <!-- <button type="button" class="btn" data-toggle="modal" data-target="#editModal" title="Edit" id="editProfile">Change</button> -->
                                <button class="btn btn-outline-primary" name="edit" id="edit">Edit</button>
                                <div class="row" style="margin-left:0">
                                    <button class="btn btn-outline-success" name="submit" id="submit" form="save">Save Changes</button>
                                    <button class="btn btn-outline-danger" name="cancel" id="cancel" style="margin-left:10px;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="showAppointment" name="showAppointment" style="margin-top:20px;">

                        <table class="table table-striped" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>User_Method</th>
                                    <th>Therapist</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                    <th>Create_Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>

                                    <tr>
                                        <td><?php echo $row['appointment_id'] ?></td>
                                        <td><?php echo $row['user_method'] ?></td>
                                        <td><?php echo $row['name_first'] . "&nbsp;" . $row['name_last'] ?></td>
                                        <td><?php echo $row['user_time'] ?></td>
                                        <td><?php echo $row['user_date'] ?></td>
                                        <td><?php echo $row['created_TIME'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12" id="showPayment" name="showPayment" style="margin-top:20px;">
                        <!-- <div class="row">
                            <div class="col-md-12" style="margin-bottom:10px;">

                                <div class="card h-100">
                                    <div class="card-body" align="center">
                                        <img src="./images/beard.png" alt="" style="width:150px;height:150px;">
                                        <h5 style="margin-top:-10px;margin-bottom:20px;">Halo</h5>
                                    </div>
                                </div>

                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="js/edit.js" type="text/javascript"></script>
</body>
</html>
