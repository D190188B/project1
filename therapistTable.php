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

if (isset($_POST['delete'])) {
    $deleteID = $_POST['delete'];

    $sql="delete from therapist where id='$deleteID'";
    $result= $conn->query($sql);

    if($result==true){
        echo '<script>window.alert("Delete Successful....!!!!")</script>';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="project.css"> -->
    <title>Therapist Table</title>
</head>
<style>
    .custab {
        border: 1px solid #ccc;
        padding: 5px;
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }

    .custab:hover {
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }
</style>

<body>
    <form action="therapistTable.php" method="POST">
        <div class="container" style="margin-left:100px">
            <div class="row col-md-12 col-md-offset-3">
                <a href="Admin.php"><h4 style="padding-top:20px;">Back</h4></a>
                <h4 style="padding-top:20px;padding-left:420px;">Therapists Table</h4>
                <table class="table table-striped custab" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>IC</th>
                            <th>Address</th>
                            <th>License</th>
                            <th>Profile_Image</th>
                            <th>Created_Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from therapist"; //id is database name
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) { //over 1 database(record) so run
                            while ($row = $result->fetch_assoc()) {
                                //display result
                                $id = $row['id']; //[] inside is follow database 
                                $name = $row['name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $ic = $row['ic'];
                                $address = $row['address'];
                                $license = $row['license'];
                                $profile_image = $row['profile_image'];
                                $created_at = $row['created_at'];
                        ?>

                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $phone ?></td>
                                    <td><?php echo $ic ?></td>
                                    <td><?php echo $address ?></td>
                                    <td><?php echo $license ?></td>
                                    <td><img src="<?php echo $profile_image ?>" alt="image" style="width:150px;height:150px;border-radius:50%;"></td>
                                    <td><?php echo $created_at ?></td>
                                    <td class="text-center">
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