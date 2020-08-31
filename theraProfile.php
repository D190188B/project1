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

if (isset($_SESSION['thera_id'])) {
    $id = $_SESSION['thera_id'];
    $sql = "SELECT * from therapist where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['thera_name_first'] = $row['name_first'];
            $_SESSION['thera_name_last'] = $row['name_last'];
            $_SESSION['thera_about'] = $row['about'];
            $_SESSION['thera_gender'] = $row['gender'];
            $_SESSION['thera_address'] = $row['address'];
            $_SESSION['thera_city'] = $row['therapist_city'];
            $_SESSION['thera_postCode'] = $row['therapist_postCode'];
            $_SESSION['thera_state'] = $row['therapist_state'];
            $_SESSOPM['thera_phone'] = $row['phone'];
            $_SESSION['thera_age'] = $row['age'];
            $_SESSION['thera_email'] = $row['email'];
            $_SESSION['thera_license'] = $row['license'];
            $_SESSION['thera_profile_image'] = $row['profile_image'];
            $_SESSION['thera_gender'] = $row['gender'];
        }
    }
}

$id = $_SESSION['thera_id'];

$sqli = "SELECT * from appointment left join client on appointment.user_Email=client.email where therapist_ID='$id'";
$result = $conn->query($sqli) or die($conn->error . __LINE__);

//check the pathinfo and upload the image
function upload_thera($path, $file)
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

if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>window.location.assign("therapistLogin.php")</script>';
}


if (isset($_POST['submit'])) {
    $error = array();

    $files = $_FILES['uploadProfile'];
    $profileImage = upload_thera('./images/therapists/', $files);


    $about = mysqli_real_escape_string($conn, $_POST['about']);
    if (empty($about)) {
        $error[] = "You forgot to enter your about";
    }

    $name_first = validate_input_text($_POST['nameFirst']);
    if (empty($name_first)) {
        $error[] = "You forgot to enter your name_first";
    }

    $name_last = validate_input_text($_POST['nameLast']);
    if (empty($name_last)) {
        $error[] = "You forgot to enter your name_last";
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

    $postCode = validate_input_text($_POST['postCode']);
    if (empty($postCode)) {
        $error[] = "You forgot to enter your postCode";
    }

    $state = validate_input_text($_POST['state']);
    if (empty($state)) {
        $error[] = "You forgot to enter your state";
    }

    if (empty($error)) {
        $id = $_SESSION['thera_id'];
        $sql = "update therapist set name_first='$name_first',name_last='$name_last',about='$about',phone='$phone',address='$address',therapist_city='$city',therapist_postCode='$postCode',therapist_state='$state',profile_image='$profileImage' where therapist_id='$id'";

        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result == true) {
            $_SESSION['thera_name_first'] = $_POST['nameFirst'];
            $_SESSION['thera_name_last'] = $_POST['nameLast'];
            $_SESSION['thera_about'] = $_POST['about'];
            $_SESSOPM['thera_phone'] = $_POST['phone'];
            $_SESSION['thera_address'] = $_POST['address'];
            $_SESSION['thera_city'] = $_POST['city'];
            $_SESSION['thera_state'] = $_POST['state'];
            $_SESSION['thera_postCode'] = $_POST['postCode'];
            $_SESSION['thera_profile_image'] = $profileImage;

            header('refresh: 0; url=theraProfile.php');
        }
    }
}
//get current date
$date = date("Y-m-d");

//display today list
$sql = "SELECT * FROM appointment LEFT JOIN therastatus on appointment.appointment_status=therastatus.id where therapist_ID='$id' and user_date='$date' ORDER BY created_TIME DESC";
$result = $conn->query($sql) or die($conn->error . __LINE__);
//display today number
$getRe = $conn->query($sql) or die($conn->error . __LINE__);
//display totol number
$getReTol = $conn->query($sql) or die($conn->error . __LINE__);

//display waiting number
$wait = "SELECT * FROM appointment LEFT JOIN therastatus on appointment.appointment_status=therastatus.id where therapist_ID='$id' and appointment_status='1' ORDER BY created_TIME DESC";
$getWait = $conn->query($wait) or die($conn->error . __LINE__);
//display waiting list
$getWaitList = $conn->query($wait) or die($conn->error . __LINE__);
//display total number
$getWaitTol = $conn->query($wait) or die($conn->error . __LINE__);

//display all list
$all = "SELECT * FROM appointment LEFT JOIN therastatus on appointment.appointment_status=therastatus.id where therapist_ID='$id' ORDER BY created_TIME DESC";
$getAll = $conn->query($all) or die($conn->error . __LINE__);

if ($getReTol->num_rows > 0) {
}

//today number
$TodayNum = 0;
//waiting number
$WaitNum = 0;
//total number
$AppointmentTotal = 0;

//if today number is over 0
if ($getReTol->num_rows > 0) {
    while ($row = $getReTol->fetch_assoc()) {
        ++$AppointmentTotal;
    }
}

//if total wait number is over 0
if ($getWaitTol->num_rows > 0) {
    while ($row = $getWaitTol->fetch_assoc()) {
        ++$AppointmentTotal;
    }
}

//if accept
if (isset($_POST['accept'])) {
    $id = $_POST['accept']; //id
    $statusID = 2;
    $sql = "update appointment set appointment_status='$statusID' where appointment_id='$id'"; //set status=2 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}


//if reject
if (isset($_POST['reject'])) {
    $id = $_POST['reject']; //id
    $statusID = 3;
    $sql = "update appointment set appointment_status='$statusID' where appointment_id='$id'"; //set status=3 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Therapist Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/therapistProfile.css">
</head>

<body>
    <section id="thera_profile">

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="col-md-12">
                        <img class="camera-icon" src="images/camera-solid.svg" alt="camera" id="camera_icon">
                        <img src="<?php echo $_SESSION['thera_profile_image'] ?>" alt="image" id="therapist_image">
                        <input type="file" name="uploadProfile" id="uploadProfile" form="thera_save" class="form-control-file">
                        <h6 style="margin-top:20px;" id="changePro">Change profile photo</h6>
                        <h4 class="welcome">Welcome, <?php echo $_SESSION['thera_name_first'] . "&nbsp;" . $_SESSION['thera_name_last'] ?></h4>
                    </div>

                    <div class="col-md-12 text-left left-side">
                        <ul class="noStyle">
                            <li>
                                <i class="fa fa-user" aria-hidden="true" id="profile_icon"></i>
                                <button class="theraInfo" name="theraInfoBtn" id="theraProfile">
                                    <h4 id="profile_h4">Profile</h4>
                                </button>
                            </li>

                            <li>
                                <i class="fa fa-file-o" aria-hidden="true" id="appointment_icon"></i>
                                <button class="theraInfo" name="theraInfoBtn" id="theraAppointment">
                                    <h4 id="appointment_h4">My Appointment</h4>
                                </button>&nbsp;<span class="badge badge-danger" style="padding:7px;font-size:20px;"><?php echo $AppointmentTotal ?></span>
                            </li>

                            <li>
                                <i class="fa fa-file-text-o" aria-hidden="true" id="report_icon"></i>
                                <button class="theraInfo" name="theraInfoBtn" id="theraReport">
                                    <h4 id="report_h4">Report</h4>
                                </button>
                            </li>

                            <li>
                                <i class="fa fa-cog" aria-hidden="true" id="setting_icon"></i>
                                <button class="theraInfo" name="theraInfoBtn" id="theraSetting">
                                    <h4 id="setting_h4">Setting</h4>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-12 text-left logout">
                        <form action="theraProfile.php" method="POST" id="thera_save" enctype="multipart/form-data">
                            <button class="info" type="submit" name="logout" id="logBtn" onclick="return confirm('Are you sure you want to log out?')" style="padding:7px;">
                                <i class="fa fa-sign-out" aria-hidden="true" style="font-size: 23px;padding-top: 3px;float:left"></i>
                                <h5 style="float:left;padding-left:5px;">Log out</h5>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8 right-side">
                    <div class="col-md-12" id="Profile">
                        <div class="col-md-12 text-center">
                            <h3><strong>Your personal Info</strong></h3>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" style="margin-bottom:20px;">
                                    <h4 style="color:black">About me</h4>
                                    <textarea name="about" id="about" class="form-control" cols="90" rows="10" readonly><?php echo $_SESSION['thera_about'] ?></textarea>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">First Name</h4>
                                    <input type="text" class="form-control" name="nameFirst" id="nameFirst" value="<?php echo $_SESSION['thera_name_first'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">Last Name</h4>
                                    <input type="text" class="form-control" name="nameLast" id="nameLast" value="<?php echo $_SESSION['thera_name_last'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">Phone Number</h4>
                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $_SESSOPM['thera_phone'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-12" style="margin-bottom:20px;">
                                    <h4 style="color:black">Address</h4>
                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $_SESSION['thera_address'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">City</h4>
                                    <input type="text" class="form-control" name="city" id="city" value="<?php echo $_SESSION['thera_city'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">Post Code</h4>
                                    <input type="text" class="form-control" name="postCode" id="postCode" value="<?php echo $_SESSION['thera_postCode'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">State</h4>
                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $_SESSION['thera_state'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">Email</h4>
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['thera_email'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">Age</h4>
                                    <input type="text" class="form-control" name="age" id="age" value="<?php echo $_SESSION['thera_age'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-6" style="margin-bottom:20px;">
                                    <h4 style="color:black">Gender</h4>
                                    <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $_SESSION['thera_gender'] ?>" style="border:none;outline:none;background-color:rgb(231, 231, 231);border-radius:5px;padding:5px 10px;width:100%" readonly>
                                </div>

                                <div class="col-md-12 edit">
                                    <button class="btn btn-outline-primary" name="edit" id="edit">Edit</button>
                                    <button class="btn btn-outline-success" type="submit" name="submit" id="submit" onclick="return confirm('Are you sure you want to edit?')">Save Changes</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="Appointment">
                        <!-- Nav tabs -->

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#today">Today&nbsp;<span class="badge badge-primary"><?php if ($getRe->num_rows > 0) {
                                                                                                                                            while ($row = $getRe->fetch_assoc()) {
                                                                                                                                                echo ++$TodayNum;
                                                                                                                                            }
                                                                                                                                        } ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#waiting">Wait List &nbsp;<span class="badge badge-primary"><?php if ($getWait->num_rows > 0) {
                                                                                                                                            while ($row = $getWait->fetch_assoc()) {
                                                                                                                                                echo ++$WaitNum;
                                                                                                                                            }
                                                                                                                                        } ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#earlier">Earlier&nbsp;<span class="badge badge-primary"></a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="today" class="container tab-pane active"><br>
                                <table class="table table-striped custab text-center">
                                    <thead>
                                        <tr>
                                            <th>Appointment_ID</th>
                                            <th>Client Email</th>
                                            <th>Consultation method</th>
                                            <th>Appointment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) { //over 1 database(record) so run
                                            while ($row = $result->fetch_assoc()) {
                                                //display result
                                                $appointment_id = $row['appointment_id'];
                                                $user_Email = $row['user_Email'];
                                                $user_method = $row['user_method'];
                                                $user_time = $row['user_time'];
                                                $user_date = $row['user_date'];
                                                $appointment_status = $row['appointment_status'];
                                                $statusID = $row['id'];
                                                $status = $row['status'];
                                                $created_TIME = $row['created_TIME'];

                                                $user_time1 = strtotime($row['user_time']);
                                                $user_time2 = date("h:i a", $user_time1);

                                                $user_time3 = strtotime($row['user_date']);
                                                $user_time4 = date("Y-m-d", $user_time3);

                                                $user_time5 = strtotime($row['created_TIME']);
                                                $user_time6 = date("Y-m-d h:i a", $user_time5);


                                        ?>
                                                <tr>
                                                    <td><?php echo $appointment_id ?></td>
                                                    <td><?php echo $user_Email ?></td>
                                                    <td><?php echo $user_method ?></td>
                                                    <td><?php echo $user_time4 . "<br>" . $user_time2 ?></td>
                                                    <?php if ($statusID == '2') {
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } else if ($statusID == '3') {
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } else {
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } ?>

                                                    <td><?php if ($statusID == '1') {
                                                            echo "<button name=\"accept\" type=\"submit\" class=\"btn btn-info btn-xs\" onclick=\"return confirm('Are you sure you want to Accept?')\" value=\"$appointment_id\" id=\"accept\" form=\"thera_save\">Accept</button>";
                                                            echo "<button name=\"reject\" type=\"submit\" class=\"btn btn-danger btn-xs\"  onclick=\"return confirm('Are you sure you want to Reject?')\" value=\"$appointment_id\" id=\"reject\" form=\"thera_save\">Reject</button>";
                                                        } ?></td>
                                                </tr>
                                        <?php }
                                        } ?></tbody>
                                </table>
                            </div>
                            <div id="waiting" class="container tab-pane fade"><br>
                                <table class="table table-striped custab text-center">
                                    <thead>
                                        <tr>
                                            <th>Appointment_ID</th>
                                            <th>Client Email</th>
                                            <th>Consultation method</th>
                                            <th>Appointment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($getWaitList->num_rows > 0) { //over 1 database(record) so run
                                            while ($row = $getWaitList->fetch_assoc()) {
                                                //display result
                                                $appointment_id = $row['appointment_id'];
                                                $user_Email = $row['user_Email'];
                                                $user_method = $row['user_method'];
                                                $user_time = $row['user_time'];
                                                $user_date = $row['user_date'];
                                                $appointment_status = $row['appointment_status'];
                                                $statusID = $row['id'];
                                                $status = $row['status'];
                                                $created_TIME = $row['created_TIME'];

                                                $user_time1 = strtotime($row['user_time']);
                                                $user_time2 = date("h:i a", $user_time1);

                                                $user_time3 = strtotime($row['user_date']);
                                                $user_time4 = date("Y-m-d", $user_time3);

                                                $user_time5 = strtotime($row['created_TIME']);
                                                $user_time6 = date("Y-m-d h:i a", $user_time5);


                                        ?>
                                                <tr>
                                                    <td><?php echo $appointment_id ?></td>
                                                    <td><?php echo $user_Email ?></td>
                                                    <td><?php echo $user_method ?></td>
                                                    <td><?php echo $user_time4 . "<br>" . $user_time2 ?></td>
                                                    <?php if ($statusID == '2') {
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } else if ($statusID == '3') {
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } else {
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } ?>

                                                    <td><?php if ($statusID == '1') {
                                                            echo "<button name=\"accept\" type=\"submit\" class=\"btn btn-info btn-xs\" onclick=\"return confirm('Are you sure you want to Accept?')\" value=\"$appointment_id\" id=\"accept\" form=\"thera_save\">Accept</button>";
                                                            echo "<button name=\"reject\" type=\"submit\" class=\"btn btn-danger btn-xs\"  onclick=\"return confirm('Are you sure you want to Reject?')\" value=\"$appointment_id\" id=\"reject\" form=\"thera_save\">Reject</button>";
                                                        } ?></td>
                                                </tr>
                                        <?php }
                                        } ?></tbody>

                                </table>

                            </div>
                            <div id="earlier" class="container tab-pane fade"><br>
                                <table class="table table-striped custab text-center">
                                    <thead>
                                        <tr>
                                            <th>Appointment_ID</th>
                                            <th>Client Email</th>
                                            <th>Consultation method</th>
                                            <th>Appointment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($getAll->num_rows > 0) { //over 1 database(record) so run
                                            while ($row = $getAll->fetch_assoc()) {
                                                //display result
                                                $appointment_id = $row['appointment_id'];
                                                $user_Email = $row['user_Email'];
                                                $user_method = $row['user_method'];
                                                $user_time = $row['user_time'];
                                                $user_date = $row['user_date'];
                                                $appointment_status = $row['appointment_status'];
                                                $statusID = $row['id'];
                                                $status = $row['status'];
                                                $created_TIME = $row['created_TIME'];

                                                $user_time1 = strtotime($row['user_time']);
                                                $user_time2 = date("h:i a", $user_time1);

                                                $user_time3 = strtotime($row['user_date']);
                                                $user_time4 = date("Y-m-d", $user_time3);

                                                $user_time5 = strtotime($row['created_TIME']);
                                                $user_time6 = date("Y-m-d h:i a", $user_time5);


                                        ?>
                                                <tr>
                                                    <td><?php echo $appointment_id ?></td>
                                                    <td><?php echo $user_Email ?></td>
                                                    <td><?php echo $user_method ?></td>
                                                    <td><?php echo $user_time4 . "<br>" . $user_time2 ?></td>
                                                    <?php if ($statusID == '2') {
                                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } else if ($statusID == '3') {
                                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } else {
                                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                                    } ?>

                                                    <td><?php if ($statusID == '1') {
                                                            echo "<button name=\"accept\" type=\"submit\" class=\"btn btn-info btn-xs\" onclick=\"return confirm('Are you sure you want to Accept?')\" value=\"$appointment_id\" id=\"accept\" form=\"thera_save\">Accept</button>";
                                                            echo "<button name=\"reject\" type=\"submit\" class=\"btn btn-danger btn-xs\"  onclick=\"return confirm('Are you sure you want to Reject?')\" value=\"$appointment_id\" id=\"reject\" form=\"thera_save\">Reject</button>";
                                                        } ?></td>
                                                </tr>
                                        <?php }
                                        } ?></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="Report">

                    </div>

                    <div class="col-md-12" id="Setting">

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
                            <span class="badge badge-danger" style="padding:7px;font-size:20px;" id="appointmentSecond_number"><?php echo $AppointmentTotal ?></span>
                        </div>
                        <div class="UserReport" id="UserReportSecond">
                            <i class="fa fa-file-text-o" aria-hidden="true" id="report_iconSecond"></i>
                        </div>
                        <div class="UserSetting" id="UserSettingSecond">
                            <i class="fa fa-cog" aria-hidden="true" id="setting_iconSecond"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="js/therapistEdit.js" type="text/javascript"></script>
</body>

</html>