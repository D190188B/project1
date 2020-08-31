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

// if delete
if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete']; //id

    $sql = "delete from therapist where therapist_id='$deleteID'"; //delete where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}

//if accept
if (isset($_POST['accept'])) {
    $id = $_POST['accept']; //id
    $statusID = 2;
    $sql = "update therapist set statusID='$statusID' where therapist_id='$id'"; //set status=2 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}


//if reject
if (isset($_POST['reject'])) {
    $id = $_POST['reject']; //id
    $statusID = 3;
    $sql = "update therapist set statusID='$statusID' where therapist_id='$id'"; //set status=3 where therapist_id == this.id
    $result = $conn->query($sql) or die($conn->error . __LINE__);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Therapist Table</title>
</head>
<style>
    .custab {
        border: 1px solid #ccc;
        padding: 5px;
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
        text-align: center;
    }

    .custab:hover {
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }

    button.btn {
        margin-bottom: 10px;
    }

</style>

<body>
    <form action="therapistTable.php" method="POST" enctype="multipart/form-data">
        <div class="container" style="margin-left:39px">
            <div class="row col-md-12 col-md-offset-3">
                <a href="Admin.php">
                    <h4 style="padding-top:20px;">Back</h4>
                </a>
                <h4 style="padding-top:20px;padding-left:650px;">Therapists Table</h4>
                <table class="table table-striped custab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>IC</th>
                            <th>Address</th>
                            <th>License Type</th>
                            <th>Resume</th>
                            <th>Profile_Image</th>
                            <th>Created_Time</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM therapist LEFT JOIN therastatus on therapist.statusID=therastatus.id ORDER BY created_at DESC"; //id is database name
                        $result = $conn->query($sql) or die($conn->error . __LINE__);

                        if ($result->num_rows > 0) { //over 1 database(record) so run
                            while ($row = $result->fetch_assoc()) {
                                //display result
                                $id = $row['therapist_id']; //[] inside is follow database 
                                $name_first = $row['name_first'];
                                $name_last = $row['name_last'];
                                $email = $row['email'];
                                $gender = $row['gender'];
                                $age = $row['age'];
                                $phone = $row['phone'];
                                $ic = $row['ic'];
                                $address = $row['address'];
                                $therapist_city = $row['therapist_city'];
                                $therapist_postCode = $row['therapist_postCode'];
                                $therapist_state = $row['therapist_state'];
                                $license = $row['license'];
                                $resume = $row['resume'];
                                $profile_image = $row['profile_image'];
                                $statusID = $row['statusID'];
                                $created_at = $row['created_at'];
                                $status = $row['status'];

                                $user_time1 = strtotime($row['created_at']);
                                $user_time2 = date("Y-m-d h:i a", $user_time1);
                        ?>

                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name_first . "&nbsp;" . $name_last ?></td>
                                    <td><?php echo $gender ?></td>
                                    <td><?php echo $age ?></td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $phone ?></td>
                                    <td><?php echo $ic ?></td>
                                    <td><?php echo $address . ",&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_state ?></td>
                                    <td><?php echo $license ?></td>
                                    <td><?php echo $resume ?></td>
                                    <td><img src="<?php echo $profile_image ?>" alt="image" style="width:150px;height:150px;border-radius:50%;"></td>
                                    <td><?php echo $user_time2 ?></td>


                                    <?php
                                    if ($statusID == '2') {
                                        echo "<td style=\"color:green;font-size:20px;font-weight:bold;\">$status</td>";
                                    } else if ($statusID == '3') {
                                        echo "<td style=\"color:red;font-size:20px;font-weight:bold;\">$status</td>";
                                    } else {
                                        echo "<td style=\"color:black;font-size:20px;font-weight:bold;\">$status</td>";
                                    }
                                    ?>

                                    <td class="text-center">
                                        <?php
                                        if ($statusID == '1') {
                                            echo "<button name=\"accept\" type=\"submit\" class=\"btn btn-outline-success btn-xs\" onclick=\"return confirm('Are you sure you want to Accept?')\" value=\"$id\">Accept</button>";
                                            echo "<button name=\"reject\" type=\"submit\" class=\"btn btn-outline-danger btn-xs\"  onclick=\"return confirm('Are you sure you want to Reject?')\" value=\"$id\">Reject</button>";
                                        }
                                        ?>

                                        <button name="delete" type="submit" class="btn btn-danger btn-xs" value="<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</button>



                                    </td>
                                </tr>
                        <?php
                            } //end while
                        } //end if
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</body>

</html>
