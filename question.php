<?php
include("sessionTop.php");
$generateID = uniqid();

//if user get started the question
if ((isset($_GET['id']) || isset($_GET['work_id'])) && isset($_SESSION['client_id'])) {
    if (isset($_GET['id'])) {
        $_SESSION['rec_work_id'] = $_GET['id'];
        $_SESSION['work_id'] = '';
    } else if (isset($_GET['work_id'])) {
        $_SESSION['work_id'] = $_GET['work_id'];
        $_SESSION['rec_work_id'] = '';
    }
    $_SESSION['generate_id'] = $generateID;

} else if (!isset($_SESSION['client_id'])) { //if user dosen't log in
    echo '<script>window.alert("You must login first!");window.location.assign("login.php")</script>';
} else if (((empty($_SESSION['rec_work_id'])) && (empty($_SESSION['work_id']))) && (isset($_SESSION['client_id']))) { // if user already log in but directly access this page
    echo '<script>window.alert("You cannot directly access this page...!");window.location.assign("help.php")</script>';
}

if (isset($_POST['finish'])) {//if finish the recommendation question
    foreach ($_REQUEST['allChoices'] as $choice) {
        $email = $_SESSION['client_email'];
        $sql = "INSERT into user_choices values('','$generateID','$choice','$email')";
        $result = $conn->query($sql) or die($conn->error . __LINE__);
    }
    echo '<script>window.location.assign("showResult.php");</script>';
}

if (isset($_POST['finish1'])) {//if finish without the recommendation question
    foreach ($_REQUEST['allChoices'] as $choice) {
        $email = $_SESSION['client_email'];
        $sql = "INSERT into user_choices values('','$generateID','$choice','$email')";
        $result = $conn->query($sql) or die($conn->error . __LINE__);
    }
    echo '<script>window.location.assign("Appointment.php");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <style>
        body {
            background-color: rgba(210, 232, 243) !important;
            padding-top: 60px;
            padding-bottom: 20px;
        }
    </style>
</head>
<header>
    <?php include("header1.php") ?>
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
                        <form action="question.php" method="POST" enctype="multipart/form-data">
                            <h3>Answer the questions and get matched a suitable therapist!</h3>
                            <hr>
                            <p id="over">Over the past 2 weeks, how often have you bothered by any of the following problems: </p>
                            <center>
                                <h4 class="question-text" id="complete" style="display:none;"><strong>You've completed the questionnaire!</strong></h4>
                            </center>
                            <!-- Show the question -->
                            <?php
                            $sql = "SELECT * FROM questions";
                            $result = $conn->query($sql) or die($conn->error . __LINE__);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $question_number = $row['question_number'];
                                    $question_text = $row['question_text'];
                            ?>
                                    <?php
                                    if ($question_number == "1") {
                                        echo "<h4 class='question-text question$question_number'>$question_text</h4>";
                                    } else {
                                        echo "<h4 class='question-text question$question_number' style='display:none'>$question_text</h4>";
                                    }
                                    ?>
                            <?php
                                }
                            }
                            ?>
                            <hr>
                            <div id="showChoices">
                                <ul class="choices" id="choices">
                                    <!-- If the choices belongs to this question -->
                                    <?php
                                    $sql = "SELECT * FROM choices";
                                    $result = $conn->query($sql) or die($conn->error . __LINE__);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $choice_id = $row['choice_id'];
                                            $question_number = $row['question_number'];
                                            $text = $row['text'];
                                    ?>
                                            <?php
                                            if ($question_number == "1") {
                                                echo "<li class='choice$question_number' value='$choice_id'>
                                                        <div class='custom-control custom-radio' id='allChoice'>
                                                            <input type='radio' class='custom-control-input' name='choice' id='" . $choice_id . "' value='" . $choice_id . "'>
                                                            <label class='custom-control-label' for='" . $choice_id . "'><strong><span>$text</span></strong></label>
                                                        </div>
                                                        
                                                        <div class='form-check form-check-inline' style='display:none;'>
                                                            <input class='form-check-input' type='checkbox' id='check$choice_id' name='allChoices[]' value='$choice_id'>
                                                            <label class='form-check-label' for='check$choice_id'>$choice_id</label>
                                                        </div>
                                                    </li>";
                                            } else {
                                                echo "<li class='choice$question_number' style='display:none' value='$choice_id'>
                                                        <div class='custom-control custom-radio' id='allChoice'>
                                                            <input type='radio' class='custom-control-input' name='choice' id='" . $choice_id . "' value='" . $choice_id . "' >
                                                            <label class='custom-control-label' for='" . $choice_id . "'><strong><span>$text</span></strong></label>
                                                        </div>

                                                        <div class='form-check form-check-inline' style='display:none;'>
                                                            <input class='form-check-input' type='checkbox' id='check$choice_id' name='allChoices[]' value='$choice_id'>
                                                            <label class='form-check-label' for='check$choice_id'>$choice_id</label>
                                                        </div>
                                                    </li>";
                                            }
                                            ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <?php
                                if ((isset($_GET['id']) || (!empty($_SESSION['rec_work_id']))) && isset($_SESSION['client_id'])) {
                                    echo "<input type='submit' value='Finish' name='finish' id='finish' class='btn btn-outline-success' style='display:none'>";
                                    echo "<input type='hidden' id='theraCheck' data-value='1'>";
                                } else {
                                    echo "<input type='submit' value='Finish' name='finish1' id='finish1' class='btn btn-outline-success' style='display:none'>";
                                    echo "<input type='hidden' id='theraCheck' data-value='2'>";
                                }
                                ?>
                            </div>
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
    <script src="js/main.js" type="text/javascript"></script>
</section>

</html>
