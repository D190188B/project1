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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
    <link rel="stylesheet" type="text/css" href="css/Help.css">

</head>

<header>
    <?php require_once("header1.php") ?>
</header>

<section id="help">

    <body>
        <div class="top-service">
            <img src="images/onlineService.jpg" alt="onlineService">
            <div class="service-inside">
                <h2>Help yourself to thrive with professional therapist</h2>
            </div>
        </div>

        <div class="container-fluid">
            <h3></h3>
            <div class="col-md-12">
                <h2 style="text-align:center;margin-bottom:50px;margin-top:20px;font-family:Arial, Helvetica, sans-serif">Therapists that can help with...</h2>
                
                    <div class="row">
                    <?php
                        $sql = "select * from services"; //id is database name
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) { //over 1 database(record) so run
                            while ($row = $result->fetch_assoc()) {
                                //display result
                                $id = $row['id']; //[] inside is follow database 
                                $name = $row['name'];
                                $image = $row['image'];
                        ?>

                        <div class="col-sm-4" style="margin-bottom:10px;">
                            <div class="card h-100">
                                <div class="card-body" align="center">
                                    <h5 style="margin-top:-10px;margin-bottom:20px;"><?php echo $name ?></h5>
                                    <img src="<?php echo $image ?>" alt="image" id="imageService"class="img-fluid">
                                    <div class="card-heading" style="text-align:center;margin-top:10px;"><a href="home.php" class="btn btn-success btn-xs">Select</a></div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                
            </div>
        </div>

        <div class="work">


        </div>
        <?php require_once("footer.php") ?>
    </body>



</section>

</html>