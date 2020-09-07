<?php
include("sessionTop.php");
date_default_timezone_set('Singapore');


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

if (isset($_SESSION['work_id'])) {

    if (isset($_SESSION['id'])) {

        if (!empty($_SESSION['work_id'])) {
            $therapist_id = $_SESSION['work_id'];
            $sql = "SELECT * FROM therapist where therapist_id='$therapist_id'"; //id is database name
            $result = $conn->query($sql) or die($conn->error . __LINE__);

            if ($result->num_rows > 0) { //over 1 database(record) so run
                while ($row = $result->fetch_assoc()) {
                    //display result
                    $select_id = $row['therapist_id']; //[] inside is follow database 
                    $select_name_first = $row['name_first'];
                    $select_name_last = $row['name_last'];
                    $select_email = $row['email'];
                    $select_gender = $row['gender'];
                    $select_age = $row['age'];
                    $select_phone = $row['phone'];
                    $select_ic = $row['ic'];
                    $select_address = $row['address'];
                    $select_therapist_city = $row['therapist_city'];
                    $select_therapist_postCode = $row['therapist_postCode'];
                    $select_therapist_state = $row['therapist_state'];
                    $select_license = $row['license'];
                    $select_resume = $row['resume'];
                    $select_profile_image = $row['profile_image'];
                    $select_statusID = $row['statusID'];
                    $select_created_at = $row['created_at'];
                }
            }

            $sqli = "select * from select_question where user_email='$email'";
            $run = $conn->query($sqli) or die($conn->error . __LINE__);
            $result1 = $run->fetch_assoc();
        }
    } else {
        echo '<script>window.alert("You must login first..!!");window.location.assign("login.php")</script>';
    }
}

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
    $error = array();

    $email = validate_input_email($_POST['email']);
    if (empty($email)) {
        $error[] = "You forgot to enter your email";
    }

    $method = validate_input_text($_POST['method']);
    if (empty($method)) {
        $error[] = "You forgot to enter your method";
    }

    $time = mysqli_real_escape_string($conn, $_POST['time']);
    if (empty($time)) {
        $error[] = "You forgot to enter your time";
    }

    $date = mysqli_real_escape_string($conn, $_POST['date']);
    if (empty($date)) {
        $error[] = "You forgot to enter your date";
    }
    $therapistID = validate_input_text($_POST['therapistID']);
    if (empty($therapistID)) {
        $error[] = "You forgot to enter your therapistID";
    }

    $user_time1 = strtotime($time);
    $user_time2 = date("h:i a", $user_time1);

    $user_time3 = strtotime($date);
    $user_time4 = date("Y-m-d", $user_time3);

    if (empty($error)) {
        $sql = "INSERT INTO `appointment` VALUES('$generateid','$email','$method','$user_time2','$user_time4','$therapistID',1,1,NOW())";
        $result = $conn->query($sql) or die($conn->error . __LINE__);

        if ($result == true) {

            $msg = "<div class='alert alert-success'>Booking Successfull,Will Go to the Home Page after 3 seconds</div>";
            header('refresh: 3; url=Home.php');
            $_SESSION['generate_id'] = '';
            $_SESSION['user_email'] = '';
        }
    }else{
        $msg = "<div class='alert alert-danger'>Something error, Please Try Again!</div>";
    }
}

function build_calendar($month, $year)
{
    $servername = "localhost"; //localhost for local PC or use IP address
    $username = "root"; //database name
    $password = ""; //database password
    $database = "oncoun"; //database name

    // Create connection #scawx
    $conn = new mysqli($servername, $username, $password, $database);


    $sql = "SELECT * FROM appointment";
    //display all the appointment
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    //First of all we'll create an array containing names of all days in a week
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    //Then we'll get the first day of the month that is in the argument of this function
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //Now getting the number of days in a month
    $numberDays = date('t', $firstDayOfMonth);

    //Getting some information about the first day of this month
    $dateComponents = getdate($firstDayOfMonth);

    //Getting the name of this month
    $monthName = $dateComponents['month'];

    //Getting the index value 0-6 of the first day of this month
    $dayOfWeek = $dateComponents['wday'];


    //Now creating the HTML table
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-xs btn-danger' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "' id='Previous'>Previous Month</a> ";

    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";

    $calendar .= "<a class='btn btn-xs btn-success' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></center><br>";


    $calendar .= "<thead><tr>";

    //Creating the calendar headers
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $bookings = array();
    $calendar .= "</tr></thead><tbody><tr>";
    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row['user_date'];
        }
    }

    //The variable $dayOfWeek will make sure that there must be only 7 columns

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td></td>";
        }
    }

    //initiating the day counter
    $currentDay = 1;

    //Getting the month number
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);


    //Getting the current date
    $dateToday = date('Y-m-d');

    while ($currentDay <= $numberDays) {
        //if seventh column (saturday) reached,start a new row
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        if ($date <= $dateToday) {
            $calendar .= "<td><h5>$currentDay</h5><button class='btn btn-danger btn-xs booking' disabled>Book</button>";
        } else if (in_array($date, $bookings)) {
            $calendar .= "<td><h5>$currentDay</h5><button class='btn btn-danger booking' disabled>Already Booked</button>";
        } else {
            $calendar .= "<td><h5>$currentDay</h5><button class='btn btn-success btn-xs booking book' data-dateslot='$year-$month-$currentDay'>Book</button>";
        }

        $calendar .= "</td>";

        //Incrementing the counters
        $currentDay++;
        $dayOfWeek++;
    }



    //Compeleting the row of the last week in month,if necessary
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td></td>";
        }
    }

    $calendar .= "</tr></tbody>";
    $calendar .= "</table>";

    echo $calendar;
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/appointment.css">
    <style>
        table {
            table-layout: fixed;
            background-color: white;
        }

        tbody {
            color: rgb(133, 133, 133);
        }

        .booking {
            font-size: 15px !important;
            padding: 5px 5px !important;

        }

        table td {
            padding: 5px 0 5px 5px !important;

        }
    </style>
</head>

<header>
    <?php require_once("header1.php") ?>
</header>
<section id=appointment>

    <body>

        <div class="container">
            <section class="form pt-5 pb-5">

                <!-- Appointment Form -->
                <div class="container">
                    <div class="row" style="margin-top:30px;">

                        <div class="col-md-12">
                            <?php if (isset($_POST['upload'])) {
                                echo $msg;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 style="color:white">Appointment</h1>
                                </div>
                            </div>

                            <!-- <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="color:white">Email</h5>
                                        <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 style="color:white">Method</h5>
                                        <select id="method" name="method" class="custom-select" required>
                                            <option value="phone">Phone</option>
                                            <option value="online chat">Online Chat</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="color:white">Date and Time</h5>
                                        <input type="time" name="time" placeholder="Time" required>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 style="color:white">Date</h5>
                                        <input type="date" name="date" placeholder="Date of Birth" required>
                                    </div>
                                </div> -->

                            <div class="row">
                                <div class="col-md-10 offset-md-1 bg-white my-0">
                                    <?php
                                    $dateComponents = getdate();
                                    if (isset($_GET['month']) && isset($_GET['year'])) {
                                        $month = $_GET['month'];
                                        $year = $_GET['year'];
                                    } else {
                                        $month = $dateComponents['mon'];
                                        $year = $dateComponents['year'];
                                    }

                                    echo build_calendar($month, $year);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="offset-md-1 col-md-10 my-4">
                                    <h5 style="color:white">Therapist</h5>
                                    <div class="row" style="padding:20px;border:1px solid white;">
                                        <div class="col-md-6" align="center">
                                            <img src="<?php if ((isset($_SESSION['work_id'])) && (!empty($_SESSION['work_id']))) {
                                                            echo $select_profile_image;
                                                        } else if (isset($_GET['id'])) {
                                                            echo $profile_image;
                                                        } ?>" alt="img">
                                        </div>

                                        <div class="col-md-6">
                                            <h3 class="therapist_name"><?php if ((isset($_SESSION['work_id'])) && (!empty($_SESSION['work_id']))) {
                                                                            echo $select_name_first . "&nbsp;" . $select_name_last;
                                                                        } else if (isset($_GET['id'])) {
                                                                            echo $name_first . "&nbsp;" . $name_last;
                                                                        } ?></h3>
                                            <h3 class="therapist_license"><?php if ((isset($_SESSION['work_id'])) && (!empty($_SESSION['work_id']))) {
                                                                                echo $select_license;
                                                                            } else if (isset($_GET['id'])) {
                                                                                echo $license;
                                                                            } ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end Appointment Form -->

        </div>
        <div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle">Booking for: <span id="slot"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="Appointment.php" method="POST" enctype="multipart/form-data" class="validation" novalidate>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" readonly name="date" id="dateslot" class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="method">Method</label>
                                        <select id="method" name="method" class="custom-select">
                                            <option value="phone">Phone</option>
                                            <option value="online chat">Online Chat</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="time">Time</label>
                                        <input type="time" class="form-control" name="time" placeholder="Time" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please Select the book time</div>

                                        <input type="hidden" name="therapistID" value="<?php if ((isset($_SESSION['work_id'])) && (!empty($_SESSION['work_id']))) {
                                                                                            echo $select_id;
                                                                                        } else if (isset($_GET['id'])) {
                                                                                            echo $id;
                                                                                        } ?>">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Submit Appointment -->
                        <input type="submit" name="upload" value="Submit Appointment" class="form-control" onclick="return confirm('Confirm to submit?')">
                        <!-- End submit -->
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".book").click(function() {
                var dateslot = $(this).attr('data-dateslot');
                $("#slot").html(dateslot);
                $("#dateslot").val(dateslot);
                $('#dateModal').modal("show");
            });
        });

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('validation');
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
</section>
<footer>
    <?php require_once("footer.php"); ?>
</footer>

</html>
