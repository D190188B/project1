<?php
$servername = "localhost"; //localhost for local PC or use IP address
$username = "root"; //database name
$password = ""; //database password
$database = "oncoun"; //database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password, $database);
session_start();
// Check connection #scawx
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$email = $_SESSION['email']; //get user email
$sql = "SELECT * FROM select_question WHERE user_email='$email'"; //get the id from select_question
$result = $conn->query($sql) or die($conn->error . __LINE__);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_SESSION['generate_id'] = $row['generate_id'];
        $_SESSION['user_email'] = $row['user_email'];
    }
} else {
    $_SESSION['generate_id'] = '';
    $_SESSION['user_email'] = '';
}

$generateid = $_SESSION['generate_id'];

//get the user choices
$query = "select * from user_choices where selectID='$generateid'";
$choices = $conn->query($query) or die($conn->error . __LINE__);
$choice = $choices->fetch_assoc();



if (isset($_GET['id'])) { //get therapist id
    $email = $_SESSION['email'];
    $id = $_GET['id'];
    $sql = "select * from therapist where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_state = $row['therapist_state'];
            $therapist_postCode = $row['therapist_postCode'];
            $profile_image = $row['profile_image'];
            $license = $row['license'];
        }
    }



    $sqli = "select * from select_question where user_email='$email'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    $result1 = $run->fetch_assoc();
}


if (isset($_POST['upload'])) { //upload appointment
    $email = $_POST['email'];
    $method = $_POST['method'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $therapistID = $_POST['therapistID'];

    $sql = "INSERT INTO `appointment` VALUES('$generateid','$email','$method','$time','$date','$therapistID',NOW())";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result == true) {
        echo '<script>window.alert("Successful...!");window.location.assign("profile.php")</script>';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Appointment</title>
    <link rel="stylesheet" type="text/css" href="css/appointment.css">
</head>


<header>
    <?php require_once("header1.php") ?>
</header>

<body>

    <section id=appointment>
        <form action="Appointment.php" method="POST">
            <div class="container">
                <section class="form pt-5 pb-5">

                    <!-- Appointment Form -->
                    <div class="container">
                        <div class="row" style="margin-top:60px;">

                            <div class="offset-md-2 col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1 style="color:white">Appointment</h1>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="color:white">Email</h5>
                                        <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 style="color:white">Method</h5>
                                        <select id="method" name="method" require>
                                            <option value="phone">Phone</option>
                                            <option value="online chat">Online Chat</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="color:white">Time</h5>
                                        <input type="time" name="time" placeholder="Time" required>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 style="color:white">Date</h5>
                                        <input type="date" name="date" placeholder="Date of Birth" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 style="color:white">Therapist</h5>
                                        <div class="row" style="padding:20px;border:1px solid white;">
                                            <div class="col-md-6" align="center">
                                                <img src="<?php echo $profile_image ?>" alt="img">
                                                <?php $appointmentID = $result1['generate_id'] ?>
                                            </div>

                                            <div class="col-md-6">
                                            <input type="hidden" name="therapistID" value="<?php echo $id ?>">
                                            <h3 class="therapist_name"><?php echo $name_first . "&nbsp;" . $name_last ?></h3>
                                            <h3 class="therapist_license"><?php echo $license ?></h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row" align=center>
                                    <!-- Submit Appointment -->
                                    <div class="col-md-12">
                                        <input type="submit" name="upload" value="Submit Appointment" onclick="return confirm('Confirm to submit?')">
                                    </div>
                                    <!-- End submit -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end Appointment Form -->
                </section>
            </div>

            <?php require_once("footer.php"); ?>
        </form>
    </section>
</body>



</html>
