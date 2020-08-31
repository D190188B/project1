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

mysqli_set_charset($conn, 'utf8');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/appointment.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/FAQ.css">
    <link rel="stylesheet" type="text/css" href="css/Help.css">
    <link rel="stylesheet" type="text/css" href="css/Therapistinfo.css">
    <link rel="stylesheet" type="text/css" href="css/Profile.css">
    <link rel="stylesheet" type="text/css" href="css/Reviews.css">
    <link rel="stylesheet" type="text/css" href="css/therapistRegister.css">
    <link rel="stylesheet" type="text/css" href="css/OurTherapist.css">
    <link rel="stylesheet" type="text/css" href="css/theraDetail.css">
    <link rel="stylesheet" type="text/css" href="css/profileCopy.css">
    
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



</head>

<html>
<html lang="en">

    <header id="header1">
        <!-- nav bar -->
        <form action="header1.php" method="post">

            <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="position:fixed;background-color:rgba(34,19,48);">
                <!-- Brand -->
                <a class="navbar-brand" href="Home.php">Logo</a>

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links -->
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 " id="collapsibleNavbar">

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="help.php" style="color:white">Service</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="FAQ.php" style="color:white">FAQ</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="Reviews.php" style="color:white">Reviews</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="OurTherapist.php" style="color:white">Our Therapist</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="Therapistinfo.php" style="color:white">Therapist Job</a>
                        </li>

                        <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button type="submit" style="background-image: linear-gradient( 109.6deg,  rgba(102,203,149,1) 11.2%, rgba(39,210,175,1) 98.7% );color:white;border:solid;border-radius:9px;border-width:1px;border-color:green;color:black;">Self Test</button>
                        </a>
                    </li> -->


                        <?php
                        if (isset($_SESSION['id'])) {
                            echo " <li class=\"nav-item active\"><a class=\"nav-link\" href=\"profileCopy.php\" style=\"color:white;\">Profile</a></li>";
                        } else {
                            echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"login.php\" style=\"color:white;\">Login</a></li>";
                        }
                        ?>
                        </li>

                    </ul>


                </div>

            </nav>

        </form>
    </header>

</html>
