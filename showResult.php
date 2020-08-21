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


if (isset($_POST['cancel'])) { //if user click cancel, clear all the data in database where the generate_id=this.generate_id

    $number = $_POST['number'];

    $generate = $_SESSION['generate_id'];

    $sql = "delete from select_question where generate_id='$generate'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);


    $sqli = "delete from user_choices where selectID='$generate'";
    $result1 = $conn->query($sqli) or die($conn->error . __LINE__);


    echo '<script>window.location.assign("help.php");</script>';
}

if (isset($_POST['finish'])) { //if done
    echo '<script>window.location.assign("showResult.php");</script>';
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM select_question WHERE user_email='$email'"; //id is database name
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

$query = "select * from user_choices where selectID='$generateid'";
$choices = $conn->query($query) or die($conn->error . __LINE__);
$choice = $choices->fetch_assoc();

if ($choices->num_rows > 0) {
    while ($row = $choices->fetch_assoc()) {
        $choice1 = $row['choice_ID'];
        $_SESSION['user_email'] = $row['user_email'];
        if ($choice1 == 5) {
            $_SESSION['choice_gender'] = $choice1;
        } else if ($choice1 == 6) {
            $_SESSION['choice_gender'] = $choice1;
        } else if ($choice1 == 7) {
            $_SESSION['choice_gender'] = $choice1;
        } else if ($choice1 == 8) {
            $_SESSION['choice_age'] = $choice1;
        } else if ($choice1 == 9) {
            $_SESSION['choice_age'] = $choice1;
        } else if ($choice1 == 10) {
            $_SESSION['choice_age'] = $choice1;
        } else if ($choice1 == 98) {
            $_SESSION['choice_lan'] = $choice1;
        }else if ($choice1 == 99) {
            $_SESSION['choice_lan'] = $choice1;
        }else if ($choice1 == 100) {
            $_SESSION['choice_lan'] = $choice1;
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
       

    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<section id="showResult">

    <body>

        <h3>Answer the questions and get matched a suitable therapist!</h3>
        <hr id="ans">
        <div class="container">
            <div class="question-form">
                <form action="showResult.php" method="post">
                    <h4 class="question-text"><strong>Recommendation</strong></h4>
                    <hr>
                    <div class="col-md-12">

                        <div class="row">
                            <?php
                            if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==98))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and age<=44";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                Age: <?php echo $age ?> <br>
                                                Gender: <?php echo $gender ?> <br>
                                                License: <?php echo $license ?> <br>
                                                Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and age>=45";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Male'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2' and gender='Female'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==99))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan']==100))) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name_first = $row['name_first'];
                                        $name_last = $row['name_last'];
                                        $ic = $row['ic'];
                                        $age = $row['age'];
                                        $address = $row['address'];
                                        $therapist_city = $row['therapist_city'];
                                        $therapist_postCode = $row['therapist_postCode'];
                                        $therapist_state = $row['therapist_state'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                                                <?php echo $age ?> <br>
                                                <?php echo $gender ?> <br>
                                                <?php echo $license ?> <br>
                                                <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                                            </p>
                                            <h2><?php echo $license ?></h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            }
                            ?>
                            <div class="col-md-12">
                                <input type="submit" value="Cancel" name="cancel" id="cancel" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?')">
                            </div>

                        </div>

                    </div>
                </form>

            </div>
        </div>
    </body>
</section>

</html>
