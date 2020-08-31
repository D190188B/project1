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


if (isset($_SESSION['id'])) { //if already login
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
            $_SESSION['city'] = $row['city'];
            $_SESSION['state'] = $row['state'];
            $_SESSION['post_code'] = $row['post_code'];
            $_SESSION['profileImage'] = $row['profileImage'];
        }
    }
}


//check the pathinfo and upload the image
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

// prevent injection
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

// prevent injection
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


if (isset($_POST['submit'])) { //if user edit the information

    $error = array();

    $nameFirst = validate_input_text($_POST['nameFirst']);
    if (empty($nameFirst)) {
        $error[] = "You forgot to enter your nameFirst";
    }

    $nameLast = validate_input_text($_POST['nameLast']);
    if (empty($nameLast)) {
        $error[] = "You forgot to enter your nameLast";
    }

    $phone = validate_input_text($_POST['phone']);
    if (empty($phone)) {
        $error[] = "You forgot to enter your phone";
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
        $error[] = "You forgot to enter your postCode";
    }


    $files = $_FILES['uploadProfile'];
    $profileImage = upload_profile('./images/profile/', $files);

    if (empty($error)) {
        $sql = "update client set name_first='$nameFirst',name_last='$nameLast',phone='$phone',address='$address',city='$city',post_code='$postCode',state='$state',profileImage='$profileImage' where id='$id'";

        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result == true) {
            $_SESSION['name_first'] = $_POST['nameFirst'];
            $_SESSION['name_last'] = $_POST['nameLast'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['post_code'] = $_POST['postCode'];
            $_SESSION['profileImage'] = $profileImage;

            header('refresh: 0; url=profileCopy.php');
        }
    }
}

if (isset($_POST['cancel'])) {
    $deleteID = $_POST['cancel']; //id

    $sql = "delete from appointment where appointment_id='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}

//show the appointment and therapist
$email = $_SESSION['email'];

$sqli = "SELECT * from appointment left join therapist on appointment.therapist_ID=therapist.therapist_id where user_Email='$email' ORDER BY created_TIME DESC";
$result = $conn->query($sqli) or die($conn->error . __LINE__);

$getNum = $conn->query($sqli) or die($conn->error . __LINE__);

$appointmentNum = 0;
?>





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<!DOCTYPE html>
<html lang="en">

<?php require_once("header1.php") ?>

<body>
    <section id="profile_copy">
        <div class="container whole">
            <div class="row">
                <div class="col-md-4 main">
                    <div class="col-md-12">
                        <h2 style="margin:20px 0 0 20px;"><strong>User Profile</strong></h2>
                    </div>

                    <div class="col-md-12 side_left" style="margin-top: 36px;">
                        <div class="row">
                            <i class="fa fa-user-o" aria-hidden="true" id="user_icon"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="infoBtn" id="infoBtn">
                                <h4 id="user_h4">User Info</h4>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 side_left">
                        <div class="row">
                            <i class="fa fa-file-text-o" aria-hidden="true" id="appointment_icon"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="appointmentBtn" id="appointmentBtn">
                                <h4 id="appointment_h4">Appointment History</h4>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 side_left">
                        <div class="row">
                            <i class="fa fa-money" aria-hidden="true" id="payment_icon"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="paymentBtn" id="paymentBtn">
                                <h4 id="payment_h4">Your Payment</h4>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 side_left">
                        <div class="row">
                            <i class="fa fa-cog" aria-hidden="true" id="setting_icon"></i>
                            &nbsp;
                            &nbsp;
                            <button class="info" name="settingBtn" id="settingBtn">
                                <h4 id="setting_h4">Setting</h4>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12" style="margin-top: 85px;">
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
                <div class="col-md-8 Bot">
                    <div class="col-md-12" id="showInfo" name="showInfo">

                        <div class="row TopInfo">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <img class="camera-icon" src="images/camera-solid.svg" alt="camera" id="camera_icon">
                                        <img src="<?php echo $_SESSION['profileImage'] ?>" class="img" style="width:150px;height:150px;border-radius:50%;border:1px solid black" name="user_image" id="user_image">
                                        <input type="file" name="uploadProfile" id="uploadProfile" form="save" class="form-control-file">
                                        <h6 style="margin-top:20px;" id="changePro">Change profile photo</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <h4 style="color:black;margin-top:30px;"><?php echo $_SESSION['name_first'] . "&nbsp;" . $_SESSION['name_last'] ?></h4>
                                        <h5 style="color: rgb(160, 160, 160);margin-top:20px;"><?php echo $_SESSION['city'] . ",&nbsp;" . $_SESSION['state'] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row AllInfo">

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">First Name</h5>
                                <input type="text" class="form-control" name="nameFirst" id="nameFirst" value="<?php echo $_SESSION['name_first'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">Last Name</h5>
                                <input type="text" class="form-control" name="nameLast" id="nameLast" value="<?php echo $_SESSION['name_last'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">Email</h5>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['email'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">Phone Number</h5>
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $_SESSION['phone'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-12" style="margin-bottom:20px;">
                                <h5 style="color:black">Address</h5>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $_SESSION['address'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:82%;" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">City</h5>
                                <input type="text" class="form-control" name="city" id="city" value="<?php echo $_SESSION['city'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">Post Code</h5>
                                <input type="text" class="form-control" name="postCode" id="postCode" value="<?php echo $_SESSION['post_code'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">State</h5>
                                <input type="text" class="form-control" name="state" id="state" value="<?php echo $_SESSION['state'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>


                            <div class="col-md-6" style="margin-bottom:20px;">
                                <h5 style="color:black">Birth</h5>
                                <input type="text" class="form-control" name="birth" id="birth" value="<?php echo $_SESSION['birth'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:inherit" readonly>
                            </div>

                            <div class="col-md-12 edit" id="editPlace">
                                <button class="btn btn-outline-primary" name="edit" id="edit">Edit</button>
                                <div class="row" style="margin-left:0">
                                    <button class="btn btn-outline-success" name="submit" id="submit" form="save" onclick="return confirm('Are you sure you want to edit?')">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="showAppointment" name="showAppointment">
                        <table class="table table-striped" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>User_Method</th>
                                    <th>Therapist</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) :
                                    $user_time1 = strtotime($row['user_time']);
                                    $user_time2 = date("h:i a", $user_time1);
                                ?>

                                    <tr>
                                        <td><?php echo $row['appointment_id'] ?></td>
                                        <td><?php echo $row['user_method'] ?></td>
                                        <td><?php echo $row['name_first'] . "&nbsp;" . $row['name_last'] ?></td>
                                        <td><?php echo $user_time2 ?></td>
                                        <td><?php echo $row['user_date'] ?></td>
                                        <?php if (($row['appointment_status']) == 2) {
                                            echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">Approved</td>";
                                        } else if (($row['appointment_status']) == 3) {
                                            echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">Reject</td>";
                                        } else {
                                            echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">Pending</td>";
                                        } ?>

                                        <td>
                                            <button name="cancel" type="submit" form="save" class="btn btn-danger btn-xs" value="<?php echo $row['appointment_id'] ?>" onclick="return confirm('Are you sure you want to cancel?')">Cancel</button>
                                        </td>
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
            <div class="col-md-12 hand">
                <div class="row">
                    <div class="col-md-12">
                        <div class="UserIcon" id="UserIconSecond">
                            <i class="fa fa-user" aria-hidden="true" id="profile_iconSecond"></i>
                        </div>
                        <div class="UserAppointment" id="UserAppointmentSecond">
                            <i class="fa fa-calendar" aria-hidden="true" id="appointment_iconSecond"></i>
                            <span class="badge badge-danger" style="padding:7px;font-size:20px;" id="appointmentSecond_number"><?php if ($getNum->num_rows > 0) {
                                                                                                                                    while ($row = $getNum->fetch_assoc()) {
                                                                                                                                        echo ++$appointmentNum;
                                                                                                                                    }
                                                                                                                                } ?></span>
                        </div>
                        <div class="UserPayment" id="UserPaymentSecond">
                            <i class="fa fa-money" aria-hidden="true" id="payment_iconSecond"></i>
                        </div>
                        <div class="UserSetting" id="UserSettingSecond">
                            <i class="fa fa-cog" aria-hidden="true" id="setting_iconSecond"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="js/edit.js" type="text/javascript"></script>
    <script type="text/javascript">
        let profile_Second = document.querySelector('#profile_iconSecond');
        let profileIcon_Second = document.querySelector('#profile_iconSecond');

        let appointment_Second = document.querySelector('#UserAppointmentSecond');
        let appointmentIcon_Second = document.querySelector('#appointment_iconSecond');

        let payment_Second = document.querySelector('#UserPaymentSecond');
        let paymentIcon_Second = document.querySelector('#payment_iconSecond');

        let setting_Second = document.querySelector('#UserSettingSecond');
        let settingIcon_Second = document.querySelector('#setting_iconSecond');



        profile_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "black";


            appointmentIcon_Second.style.color = "white";

            paymentIcon_Second.style.color = "white";

            settingIcon_Second.style.color = "white";

            showInfoPage.style.display = "block";
            showAppointmentPage.style.display = "none";
            showPaymentPage.style.display = "none";
        });

        appointment_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "white";


            appointmentIcon_Second.style.color = "black";

            paymentIcon_Second.style.color = "white";

            settingIcon_Second.style.color = "white";

            showInfoPage.style.display = "none";
            showAppointmentPage.style.display = "block";
            showPaymentPage.style.display = "none";
        });

        payment_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "white";


            appointmentIcon_Second.style.color = "white";

            paymentIcon_Second.style.color = "black";

            settingIcon_Second.style.color = "white";

            showInfoPage.style.display = "none";
            showAppointmentPage.style.display = "none";
            showPaymentPage.style.display = "block";
        });

        setting_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "white";


            appointmentIcon_Second.style.color = "white";

            paymentIcon_Second.style.color = "white";

            settingIcon_Second.style.color = "black";

            showInfoPage.style.display = "none";
            showAppointmentPage.style.display = "none";
            showPaymentPage.style.display = "none";
        });
    </script>
</body>

</html>
