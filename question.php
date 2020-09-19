<?php
include("sessionTop.php");
$generateID = uniqid();

//if user get started the question
if (isset($_GET['id'])) {
    $_SESSION['rec_work_id'] = $_GET['id'];
    $_SESSION['generate_id'] = $generateID;
    $user_ID = $_SESSION['client_id'];
    $_SESSION['work_id'] = '';
    $sql = "select * from client where id ='$user_ID'"; //id is database name
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['client_email'] = $row['email'];
        }
    }

    $mysqli = "SELECT * FROM appointment where user_Email='" . $_SESSION['client_email'] . "' and appointment_status=1 or appointment_status=2 or appointment_status=5";
    $check = $conn->query($mysqli) or die($conn->error . __LINE__);
    $count = mysqli_num_rows($check);

    if ($count > 0) {
        $_SESSION['rec_work_id'] = '';
        $_SESSION['work_id'] = '';
        echo '<script>window.alert("You must finish the current consultation first!");window.location.assign("Help.php")</script>';
    } else {
        $sqli = "insert into select_question values('$generateID','" . $_SESSION['client_email'] . "')";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
    }


} else if (isset($_GET['work_id'])) {
    $_SESSION['work_id'] = $_GET['work_id'];
    $_SESSION['generate_id'] = $generateID;
    $user_ID = $_SESSION['client_id'];
    $_SESSION['rec_work_id'] = '';
    $sql = "select * from client where id ='$user_ID'"; //id is database name
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['client_email'] = $row['email'];
        }
    }

    $mysqli = "SELECT * FROM appointment where user_Email='" . $_SESSION['client_email'] . "' and appointment_status=1 or appointment_status=2 or appointment_status=5";
    $check = $conn->query($mysqli) or die($conn->error . __LINE__);
    $count = mysqli_num_rows($check);

    if ($count > 0) {
        $_SESSION['rec_work_id'] = '';
        $_SESSION['work_id'] = '';
        echo '<script>window.alert("You must finish the current consultation first!");window.location.assign("Help.php")</script>';
    } else {
        $sqli = "insert into select_question values('$generateID','" . $_SESSION['client_email'] . "')";
        $run = $conn->query($sqli) or die($conn->error . __LINE__);
    }

} else if (((empty($_SESSION['rec_work_id'])) && (empty($_SESSION['work_id']))) && (isset($_SESSION['client_id']))) {
    $_SESSION['rec_work_id'] = '';
    $_SESSION['work_id'] = '';
    echo '<script>window.alert("You cannot directly access this page...!");window.location.assign("help.php")</script>';
    
} else{
    $_SESSION['rec_work_id'] = '';
    $_SESSION['work_id'] = '';
    echo '<script>window.alert("You must login first!");window.location.assign("login.php")</script>';
}


//get the id from select_question
$Email = $_SESSION['client_email'];


$sql = "SELECT * FROM `select_question` WHERE user_email='$Email'";
$result1 = $conn->query($sql) or die($conn->error . __LINE__);
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $_SESSION['generate_id'] = $row['generate_id'];
        $_SESSION['user_email'] = $row['user_email'];
    }
} else {
    $_SESSION['generate_id'] = '';
    $_SESSION['user_email'] = '';
}

$generate = $_SESSION['generate_id'];


//question number
$number = (int)1;
//get questions
$query = "select * from questions where question_number=$number";


//result
$result = $conn->query($query) or die($conn->error . __LINE__);
$questions = $result->fetch_assoc();
$_SESSION['question_text'] = $questions['question_text'];
$total = $result->num_rows;

//get choices
$query = "select * from choices where question_number=$number";
$choices = $conn->query($query) or die($conn->error . __LINE__);


if (isset($_POST['submit'])) { //if user submit the choices, go to the next question until finish
    $number = $_POST['number'];
    $choice = $_POST['choice'];
    $email = $_POST['email'];
    $generate = $_SESSION['generate_id'];
    $query2 = "insert into user_choices values('','$generate','$choice','$email')";
    $results = $conn->query($query2) or die($conn->error . __LINE__);


    if ((!empty($_SESSION['work_id'])) && ($number == 2)) {
        $number = 5;
        $query = "select * from questions where question_number='$number'";
        $result = $conn->query($query) or die($conn->error . __LINE__);
        $questions = $result->fetch_assoc();
        $_SESSION['question_text'] = $questions['question_text'];
        $total = $number;
        $query1 = "select * from choices where question_number='$number'";
        $choices = $conn->query($query1) or die($conn->error . __LINE__);

        if (($result == true) && ((int)$number >= 11) && ((int)$number <= 20)) {
            echo '<style type="text/css"> 
            p#over{
                display:block !important;            
            }</style>';
        }
    } else if ((!empty($_SESSION['work_id'])) && ($number >= 5)) {
        ++$number;
        $query = "select * from questions where question_number='$number'";
        $result = $conn->query($query) or die($conn->error . __LINE__);
        $questions = $result->fetch_assoc();
        $_SESSION['question_text'] = $questions['question_text'];
        $total = $number;
        $query1 = "select * from choices where question_number='$number'";
        $choices = $conn->query($query1) or die($conn->error . __LINE__);


        if (($result == true) && ((int)$number >= 11) && ((int)$number <= 20)) {
            echo '<style type="text/css"> 
            p#over{
                display:block !important;            
            }</style>';
        }
    } else {
        //get the next question
        ++$number;
        $query = "select * from questions where question_number='$number'";
        $result = $conn->query($query) or die($conn->error . __LINE__);
        $questions = $result->fetch_assoc();
        $_SESSION['question_text'] = $questions['question_text'];
        $total = $number;
        $query1 = "select * from choices where question_number='$number'";
        $choices = $conn->query($query1) or die($conn->error . __LINE__);


        if (($result == true) && ((int)$number >= 11) && ((int)$number <= 20)) {
            echo '<style type="text/css"> 
            p#over{
                display:block !important;            
            }</style>';
        }
    }
    //get the next choices

}

if (isset($_POST['cancel'])) { //if user click cancel, clear all the data in database where the generate_id=this.generate_id

    $number = $_POST['number'];

    $generate = $_SESSION['generate_id'];

    $sql = "delete from select_question where generate_id='$generate'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($number >= 2) {
        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
    }

    $_SESSION['work_id'] = '';
    $_SESSION['rec_work_id'] = '';
    echo '<script>window.location.assign("help.php");</script>';
}



if (isset($_POST['direct'])) { //if user submit the choices, go to the next question until finish
    $number = $_POST['number'];
    $choice = $_POST['choice'];
    $email = $_POST['email'];
    $generate = $_SESSION['generate_id'];
    $query2 = "insert into user_choices values('','$generate','$choice','$email')";
    $results = $conn->query($query2) or die($conn->error . __LINE__);
    echo '<script>window.location.assign("Appointment.php");</script>';
}



if (isset($_POST['finish'])) { //if done
    echo '<script>window.location.assign("showResult.php");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: rgba(210, 232, 243) !important;
            padding-top: 60px;
            padding-bottom: 20px;
        }
    </style>
</head>
<header>
</header>

<section id="Question">

    <body>
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-10" align="center">
                            <h2>Affordable, private online counseling in Anytime,Anywhere.</h2>

                            <p>Contact with a licensed, professional therapist online.</p>

                            <p>We will matched you to a suitable therapist.Get feedback, advice and guidance from your therapist!</p>
                        </div>
                    </div>


                    <div class="col-md-6 question-form">
                        <form action="question.php" method="POST">
                            <h3>Answer the questions and get matched a suitable therapist!</h3>
                            <hr>
                            <p id="over">Over the past 2 weeks, how often have you bothered by any of the following problems: </p>
                            <!-- Show the question -->
                            <?php if ($number <= 31) {
                            ?>
                                <h4 class="question-text"><strong><?php echo $_SESSION['question_text'] ?></strong></h4>
                            <?php
                            } else { ?>
                                <center>
                                    <h4 class="question-text"><strong>You've completed the questionnaire!</strong></h4>
                                </center>
                            <?php
                            }
                            ?>
                            <hr>
                            <ul class="choices">
                                <!-- If the choices belongs to this question -->
                                <?php while ($row = $choices->fetch_assoc()) : ?>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="choice" id="<?php echo $row['choice_id'] ?>" value="<?php echo $row['choice_id'] ?>" required checked>
                                            <label class="custom-control-label" for="<?php echo $row['choice_id'] ?>"><strong><span><?php echo $row['text'] ?></span></strong></label>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>

                            <!-- If question haven't finish -->
                            <?php if ((!empty($_SESSION['work_id'])) && ($number <= 29)) {
                                echo "<input type=\"submit\" value=\"Next\" name=\"submit\" class=\"btn btn-outline-success\">";
                            } else if ((!empty($_SESSION['work_id'])) && ($number == 30)) {
                                echo "<button type=\"submit\" value=\"Finish\" name=\"direct\" class=\"btn btn-outline-success\">Finish</button>";
                            } else if ($number <= 31) {
                                echo "<input type=\"submit\" value=\"Next\" name=\"submit\" class=\"btn btn-outline-success\">";
                            } else {
                                // If done
                                echo "<input type=\"submit\" value=\"Finish\" name=\"finish\" class=\"btn btn-outline-success\">";
                            }
                            ?>
                            <!-- If cancel -->
                            <input type="submit" value="Cancel" name="cancel" id="cancel" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?')">
                            <!-- Current question number -->
                            <input type="hidden" name="number" value="<?php echo $number ?>">
                            <!-- Current id -->
                            <input name="big_id" type="hidden" value="<?php echo $_SESSION['generate_id'] ?>">
                            <!-- current user email -->
                            <input name="email" type="hidden" value="<?php echo $_SESSION['user_email'] ?>">
                        </form>
                    </div>

                    <div class="col-md-12 my-5" align="center">
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                            </ul>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <center><img src="images/therapists/hair (3).png" alt="Los Angeles" width="100" height="100"></center>
                                    <div class="carousel-caption">
                                        <h3>Los Angeles</h3>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste labore ipsum soluta exercitationem consectetur iusto. Nobis omnis iste maxime odit delectus, quasi officia optio, nulla quos tempora pariatur, perferendis modi?</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <center><img src="images/therapists/hair (3).png" alt="Los Angeles" width="100" height="100"></center>
                                    <div class="carousel-caption">
                                        <h3>Los Angeles</h3>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste labore ipsum soluta exercitationem consectetur iusto. Nobis omnis iste maxime odit delectus, quasi officia optio, nulla quos tempora pariatur, perferendis modi?</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <center><img src="images/therapists/hair (3).png" alt="Los Angeles" width="100" height="100"></center>
                                    <div class="carousel-caption">
                                        <h3>Los Angeles</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt minima odio a aperiam deleniti eveniet iusto fuga exercitationem fugiat, magni quo temporibus totam harum quia mollitia doloribus incidunt? Fuga, ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</section>

</html>
