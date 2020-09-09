<?php
include ("sessionTop.php");

//if get therapist id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from therapist where therapist_id='$id'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['detail_work_theraID'] = $row['therapist_id'];
            $_SESSION['detail_thera_name_first'] = $row['name_first'];
            $_SESSION['detail_thera_name_last'] = $row['name_last'];
            $_SESSION['detail_thera_about'] = $row['about'];
            $_SESSION['detail_thera_gender'] = $row['gender'];
            $_SESSION['detail_thera_address'] = $row['address'];
            $_SESSION['detail_thera_city'] = $row['therapist_city'];
            $_SESSION['detail_thera_postCode'] = $row['therapist_postCode'];
            $_SESSION['detail_thera_state'] = $row['therapist_state'];
            $_SESSOPM['detail_thera_phone'] = $row['phone'];
            $_SESSION['detail_thera_age'] = $row['age'];
            $_SESSION['detail_thera_email'] = $row['email'];
            $_SESSION['detail_thera_license'] = $row['license'];
            $_SESSION['detail_thera_profile_image'] = $row['profile_image'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Detail</title>

    <style>

    #submit{
        margin-top:10px;
    }
    </style>
</head>

<header>
    <?php include("header1.php") ?>
</header>
<body>

    <section id="theraDetail">
        <div class="container">
            <a href="OurTherapist.php"><h3>Back</h3></a>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center" id="theraTop">
                        <img src="<?php echo $_SESSION['detail_thera_profile_image'] ?>" alt="image" id="image" name="image">
                        <h3 class="theraName"><?php echo $_SESSION['detail_thera_name_first'] . "&nbsp;" . $_SESSION['detail_thera_name_last'] ?></h3>
                        <h4 id="theraLic"><?php echo $_SESSION['detail_thera_license'] ?></h4>
                        <h4 class="paraTop">
                            Age: <?php echo $_SESSION['detail_thera_age'] ?>
                        </h4>
                        <h4 class="paraTop">
                            Gender:<?php echo $_SESSION['detail_thera_gender'] ?>
                        </h4>

                        <a href="question.php?work_id=<?php echo $_SESSION['detail_work_theraID'] ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-danger">Work with me!</button></a>
                        <hr>
                    </div>



                    <div class="col-md-12" id="theraAbout">
                        <h3 class="theraAbout">ABOUT ME</h3>
                        <p class="para">
                            <?php echo $_SESSION['detail_thera_about'] ?>
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
