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

    $sql="delete from client where id='$deleteID'";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="project.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
    <form action="clientTable.php" method="POST">
        <div class="container" style="text-align:center;margin-left:90px">
            <div class="row col-md-10 col-md-offset-3 custyle">
                <a href="Admin.php"><h4 style="padding-top:20px;">Back</h4></a>
                <h4 style="padding-top:20px;padding-left:420px;">Clients Table</h4>
                <table class="table table-striped custab">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brith</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Profile_Image</th>
                            <th>Created_Time</th>
                            <th class="text-">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from client"; //id is database name
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) { //over 1 database(record) so run
                            while ($row = $result->fetch_assoc()) {
                                //display result
                                $id = $row['id']; //[] inside is follow database 
                                $name = $row['name'];
                                $birth = $row['birth'];
                                $phone = $row['phone'];
                                $address = $row['address'];
                                $gender = $row['gender'];
                                $email = $row['email'];
                                $profile_image = $row['profileImage'];
                                $created_at = $row['create_time'];
                        ?>


                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $birth ?></td>
                                    <td><?php echo $phone ?></td>
                                    <td><?php echo $address ?></td>
                                    <td><?php echo $gender ?></td>
                                    <td><?php echo $email ?></td>
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