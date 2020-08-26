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

//if get therapist id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from therapist where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['name_first'] = $row['name_first'];
            $_SESSION['name_last'] = $row['name_last'];
            $_SESSION['about'] = $row['about'];
            $_SESSION['age'] = $row['age'];
            $_SESSION['license'] = $row['license'];
            $_SESSION['profile_image'] = $row['profile_image'];
            $_SESSION['gender'] = $row['gender'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<?php require_once("header1.php") ?>

<body>

    <section id="theraDetail">
        <div class="container">
            <a href="OurTherapist.php"><h3>Back</h3></a>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center" id="theraTop">
                        <img src="<?php echo $_SESSION['profile_image'] ?>" alt="image" id="image" name="image">
                        <h3 class="theraName"><?php echo $_SESSION['name_first'] . "&nbsp;" . $_SESSION['name_last'] ?></h3>
                        <h4 id="theraLic"><?php echo $_SESSION['license'] ?></h4>
                        <h4 class="paraTop">
                            Age: <?php echo $_SESSION['age'] ?>
                        </h4>
                        <h4 class="paraTop">
                            Gender:<?php echo $_SESSION['gender'] ?>
                        </h4>
                        <hr>
                    </div>



                    <div class="col-md-12" id="theraAbout">
                        <h3 class="theraAbout">ABOUT ME</h3>
                        <p class="para">
                            <?php echo $_SESSION['about'] ?>
                        </p>
                        <hr>
                    </div>

                    <div class="col-md-12" id="theraSpec">
                        <h3 class="theraAbout">SPECIALTIES</h3>

                        <ul>
                            <li>Stres,Anxiety</li>
                            <li>Relationship issues</li>
                            <li>Self esteem</li>
                            <li>Depression</li>
                        </ul>
                        <p class="para"><strong>Years of Experience</strong>&nbsp;:22</p>
                        <hr>
                    </div>

                    <div class="col-md-12" id="theraService">
                        <h3 class="theraService">SERVICES OFFERED</h3>

                        <ul class="noStyle">
                            <li><i class="fa fa-comments-o" aria-hidden="true"></i>
                                <br>
                                <h5>Online Chat</h5>
                            </li>

                            <li>
                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                <br>
                                <h5>Phone</h5>
                            </li>

                            <li>
                                <i class="fa fa-video-camera" aria-hidden="true"></i>
                                <br>
                                <h5>Video</h5>
                            </li>

                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <br>
                                <h5>Face to Face</h5>
                            </li>
                        </ul>

                    </div>


                    <div class="col-md-12" id="theraLic">
                        <hr>
                        <h3 class="theraLic">LICENSING</h3>
                        <p class="para">
                            LPC #2266 (Expires: 2022-07-31)
                        </p>
                        <hr>
                    </div>

                    <div class="col-md-12" id="theraRe">
                        <h3 class="theraRe">REVIEWS</h3>
                        <p class="review">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut doloremque deserunt asperiores facilis nemo quos fuga molestiae corrupti? Ipsum autem cupiditate voluptas ducimus praesentium aliquid porro labore! A, velit eaque?
                        </p>

                        <p class="review">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, omnis. Ad nobis eveniet suscipit aliquid voluptate voluptatem a, nihil sapiente inventore perspiciatis, voluptas cupiditate magnam dolor asperiores quis eaque quam.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>


</body>

</html>