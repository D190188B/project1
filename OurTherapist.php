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

<!doctype html>
<html lang="en">

<head>
    <title>Our Therapist</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<header>
    <?php require_once("header1.php"); ?>
</header>

<section id="ourtherapist">

    <body>
        <div class="container">
            <!-- page-header -->

            <div class="page-header">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-caption">
                            <h1 class="page-title">Meet our therapist</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.page-header-->
            <!-- news -->

            <div class="card-section">
                <div class="card-block mb30" style="background-color:rgba(210,232,246);">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- section-title -->
                            <div class="section-title mb-0">
                                <h2>Counselor as Friend.</h2>
                                <p>Our Counselors are licensed, trained, experienced, and accredited psychologists (PhD / PsyD),
                                    marriage and family therapists (MFT), clinical social workers (LCSW),
                                    or licensed professional counselors (LPC). All of them have a Masters Degree or a Doctorate Degree
                                    in their field. They have been qualified and certified by their state professional board after successfully completing the necessary education, exams, training and practice. While their experience, expertise and background vary,
                                    they all possess at least 3 years and 1,000 hours of hands-on experience. </p>
                            </div>
                            <!-- /.section-title -->
                        </div>
                    </div>
                </div>
            </div>
            <form action="OurTherapist.php" method="POST">
                <div class="col-md-12">
                    <div clas="col-md-12" id="search">
                        <div class="row">
                            <input type="search" id="searchText" name="Search" class="form-control mr-sm-2">
                            <button class="btn my-2 my-sm-12" type="submit" id="searchbtn" name="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
            </form>

            <div class="card border-0" style="margin-left: -14px;margin-right:-13px;">
                <div class="row">

                    <?php
                    if (isset($_POST['submit'])) {
                        $keyword = $_POST['Search'];
                    }

                    //step:3 for search
                    $search = "";
                    if (isset($_POST['Search'])) {
                        $search =" and name like '%" . $keyword . "%'"; //（.）把keyword把search
                    }

                    $sql = "select * from therapist where statusID='2'".$search; //有where在sql，search sql 不能再有where 换成and
                    $result = $conn->query($sql); //Define sql, run sql
                    if ($result->num_rows > 0) { //over 1 database(record) so run
                        while ($row = $result->fetch_assoc()) {
                            //display result
                            $id = $row['therapist_id']; //[] inside is follow database 
                            $name = $row['name'];
                            $profile_image = $row['profile_image'];
                            $license = $row['license'];
                    ?>
                            <div class="col-md-4">
                                <div class="card h-100 border-100">
                                    <div class="card-body">
                                        <img src="<?php echo $profile_image?>" alt="" id="therapist1">
                                        <p class="therapistname"><?php echo $name ?></p>
                                        <h5 class="therapistedu"><?php echo $license ?></h5>
                                    </div>
                                </div>
                            </div>

                    <?php
                        } //while
                    } //if
                    ?>
                </div>
            </div>
        </div>
        </div>
    </body>
</section>
<!-- Team -->




<footer>
    <?php require_once("footer.php"); ?>

</footer>

</html>
