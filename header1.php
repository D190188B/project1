<?php
$servername = "localhost";//localhost for local PC or use IP address
$username = "root"; //database name
$password = "";//database password
$database = "oncoun";//database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password,$database);

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
    <link rel="stylesheet" type="text/css" href="css/Therapistinfo.css">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</head>

<html>
<html lang="en">

<header id="header1">
<!-- nav bar -->
<form action="header1.php" method="post">

        <nav class="navbar navbar-expand-md bg-warning navbar-dark fixed-top" style="position:fixed;background-image: linear-gradient( 89.2deg,  rgba(191,241,236,1) 22.3%, rgba(109,192,236,1) 84.1% );">
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
                        <a class="nav-link" href="Appointment.php" style="color:black">Appointment</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="FAQ.php" style="color:black">FAQ</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="Reviews.php" style="color:black">Reviews</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="ourThera.php" style="color:black">Our Therapist</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="TherapistInfo.php" style="color:black">Therapist Job</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                          <button type="submit" style="background-image: linear-gradient( 109.6deg,  rgba(102,203,149,1) 11.2%, rgba(39,210,175,1) 98.7% );color:white;border:solid;border-radius:9px;border-width:1px;border-color:green;color:black;">Self Test</button>
                        </a>
                    </li>

                
                    <?php
                    if(isset($_SESSION['name'])){ 
                    echo "<a class=\"nav-link\" href=\"FAQ.php\" style=\"color:black;\">Profile</a>";
                    }
                    else{
                    echo "<a class=\"nav-link\" href=\"login.php\" style=\"color:black;\">Login</a>";    
                    }
                    ?>
                  </li>
                  
                </ul>
                

            </div>
            
          </nav>
          
        </form>
        </header>          
</html>       
