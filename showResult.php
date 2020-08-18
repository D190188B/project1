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
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "select * from client where id ='$id'"; //id is database name
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['birth'] = $row['birth'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['profileImage'] = $row['profileImage'];
        }
    }
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
        if ($choice1 == 3) {
            $_SESSION['choice_ID'] = $choice1;
        } else if ($choice1 == 4) {
            $_SESSION['choice_ID'] = $choice1;
        } else if ($choice1 == 5) {
            $_SESSION['choice_ID'] = $choice1;
        } else if ($choice1 == 6) {
            $_SESSION['Therapist'] = $choice1;
        } else if ($choice1 == 7) {
            $_SESSION['Therapist'] = $choice1;
        } else if ($choice1 == 8) {
            $_SESSION['Therapist'] = $choice1;
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
        #showResult {
            background-color: rgb(255, 255, 255);

        }


        #Question span {
            padding-left: 10px;
        }

        #showResult .container {
            display: block;
            padding: 30px 0 30px 0;
            background-color: rgb(241, 241, 241);
            margin-top: 30px;
            margin-bottom: 30px;
            width: 100vw;
            height: auto;
            border-radius: 20px;
        }

        #showResult h3 {
            text-align: center;
            color: rgba(59, 82, 114);
            margin-top: 40px;
        }

        #showResult .container h4.question-text {
            text-align: center;
        }


        #showResult hr#ans {
            border: 1px solid black;
            max-width: 800px;
        }

        #showResult .container hr {
            border: 1px solid black;
        }

        .container .question-form {
            font-size: 20px;
        }

        #showResult .col-md-12 .row .col-md-6 {
            height: 250px;
        }

        #showResult .col-md-12 .row .col-md-6 img {
            border-radius: 50%;
            float: right;
            margin: 0 80px 0 0;
            width: 50%;
            height: 100%;
        }

        #showResult .col-md-12 .row .col-md-6 p {
            padding: 35px 0 0 0;
            font-size: 30px;
            color: blue;
            font-weight: 700;
        }

        #showResult button {
            text-align: center;
            margin: 40px 60px 0 0;
        }

        #showResult {
            text-align: left !important;
            margin: 40px 0x 0 0;
        }

        #showResult #cancel {
            float: right;
        }

        #showResult a {
            text-decoration: none;
            color:#28a745
        }

        #showResult a:hover{
            color: #fff;
        }
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
                            if ((($_SESSION['choice_ID']) == 3) && (($_SESSION['Therapist']) == 6)) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name = $row['name'];
                                        $ic = $row['ic'];
                                        $address = $row['address'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $statusID = $row['statusID'];
                                        $gender = $row['gender'];
                            ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name ?>
                                            </p>
                                            <h2>LCWS</h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>

                                        </div>

                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            } else if ((($_SESSION['choice_ID']) == 3) && (($_SESSION['Therapist']) == 7)) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name = $row['name'];
                                        $ic = $row['ic'];
                                        $address = $row['address'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $statusID = $row['statusID'];
                                        $gender = $row['gender'];
                                    ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name ?>
                                            </p>
                                            <h2>LCWS</h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php
                                    }
                                }
                            } else if ((($_SESSION['choice_ID']) == 3) && (($_SESSION['Therapist']) == 8)) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name = $row['name'];
                                        $ic = $row['ic'];
                                        $address = $row['address'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $statusID = $row['statusID'];
                                        $gender = $row['gender'];
                                    ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name ?>
                                            </p>
                                            <h2>LCWS</h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>

                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            } else if ((($_SESSION['choice_ID']) == 4) && (($_SESSION['Therapist']) == 6)) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name = $row['name'];
                                        $ic = $row['ic'];
                                        $address = $row['address'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $statusID = $row['statusID'];
                                        $gender = $row['gender'];
                                    ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name ?>
                                            </p>
                                            <h2>LCWS</h2>
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>


                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            } else if ((($_SESSION['choice_ID']) == 4) && (($_SESSION['Therapist']) == 7)) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name = $row['name'];
                                        $ic = $row['ic'];
                                        $address = $row['address'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $statusID = $row['statusID'];
                                        $gender = $row['gender'];
                                    ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name ?>
                                            </p>
                                            <h2>LCWS</h2>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-success"><a href="Appointment.php?id=<?php echo $id ?>">Make Appointment Now!</a></button>

                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                    <?php }
                                }
                            } else if ((($_SESSION['choice_ID']) == 4) && (($_SESSION['Therapist']) == 8)) {
                                $sqli = "SELECT * FROM `therapist` where statusID='2'";
                                $run = $conn->query($sqli) or die($conn->error . __LINE__);
                                if ($run->num_rows > 0) { //over 1 database(record) so run
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['therapist_id']; //[] inside is follow database 
                                        $name = $row['name'];
                                        $ic = $row['ic'];
                                        $address = $row['address'];
                                        $license = $row['license'];
                                        $profile_image = $row['profile_image'];
                                        $statusID = $row['statusID'];
                                        $gender = $row['gender'];
                                    ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo $profile_image ?>" alt="image">

                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <?php echo $name ?>
                                            </p>
                                            <h2>LCWS</h2>
                                            halo
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