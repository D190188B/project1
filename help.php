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
$sql = "select * from services";
$result = $conn->query($sql) or die($conn->error . __LINE__);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>

    
</head>

<header>
    <?php require_once("header1.php") ?>
</header>

<section id="help">

    <body>
        <div class="container" style="max-width: 1262px;">
            <div class="top-service">
                <img src="images/onlineService.jpg" alt="onlineService">
                <div class="service-inside">
                    <h2>Help yourself to thrive with professional therapist</h2>
                </div>
            </div>

            <form action="help.php" method="POST">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <h2 style="text-align:center;margin-bottom:50px;margin-top:20px;font-family:Arial, Helvetica, sans-serif">Therapists that can help with...</h2>

                        <div class="row">
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <div class="col-sm-3 col-xs-6" id="depression">
                                    <a href="question.php?id=<?php echo $_SESSION['id'] ?>" name="insert">
                                        <div class="serviceName">
                                            <span><?php echo $row['name'] ?></span>
                                        </div>
                                        <img src="<?php echo $row['image'] ?>" alt="image" class="img-responsive">
                                    </a>
                                </div>
                            <?php endwhile ?>
                        </div>
                    </div>
                </div>

                <div class="container bot">
                    <hr>
                    <h3 style="text-align:center">How it works</h3>
                    <div class="row inside">
                        <div class="col-md-3">
                            <h3 class="work">Tell us about yourself</h3>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p class="work-text">XXX is accepting of people from every gender, orientation and identity</p>
                        </div>

                        <div class="col-md-3">
                            <h3 class="work">Get matched to a licensed therapist</h3>
                            <i class="fa fa-id-card-o" aria-hidden="true"></i>
                            <p class="work-text">Our counselors specialize in the XXX community</p>
                        </div>

                        <div class="col-md-3">
                            <h3 class="work">Start Chatting</h3>
                            <i class="fa fa-comments-o" aria-hidden="true"></i>
                            <p class="work-text">Message whenever you want, Schedule sessions</p>
                        </div>
                    </div>

                </div>


            </form>

        </div>
    </body>
</section>
<?php require_once("footer.php") ?>

</html>
