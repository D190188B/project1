<?php
include("sessionTop.php");

$output = '';
if (isset($_POST['getLicense'])) {
    $getLicense = mysqli_real_escape_string($conn, $_POST['getLicense']);
    if ($getLicense == 'All') {
        $sql = "SELECT * FROM therapist where statusID='2'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $output .= '<div class="col-md-3">
        <a href="therapistDetail.php?id=' . $row['therapist_id'] . '">
            <div class="card h-100 border-0">
                <div class="card-body">
                    <img src="' . $row['profile_image'] . '" alt="image" id="therapist1">
                    <h4 class="therapistname">' . $row['name_first'] . '&nbsp;' . $row['name_last'] . '</h4>
                    <h5 class="therapistedu">' . $row['license'] . '</h5>
                </div>
            </div>
        </a>
    </div>';
            }
            echo $output;
        }
    } else {
        $sql = "SELECT * FROM therapist where license='$getLicense' and statusID='2'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $output .= '<div class="col-md-3">
        <a href="therapistDetail.php?id=' . $row['therapist_id'] . '">
            <div class="card h-100 border-0">
                <div class="card-body">
                    <img src="' . $row['profile_image'] . '" alt="image" id="therapist1">
                    <h4 class="therapistname">' . $row['name_first'] . '&nbsp;' . $row['name_last'] . '</h4>
                    <h5 class="therapistedu">' . $row['license'] . '</h5>
                </div>
            </div>
        </a>
    </div>';
            }
            echo $output;
        }
    }
}


if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM therapist where name_first LIKE '%" . $search . "%' or name_last LIKE '%" . $search . "%' or license LIKE '%" . $search . "%' and statusID='2'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<div class="col-md-3">
        <a href="therapistDetail.php?id=' . $row['therapist_id'] . '">
            <div class="card h-100 border-0">
                <div class="card-body">
                    <img src="' . $row['profile_image'] . '" alt="image" id="therapist1">
                    <h4 class="therapistname">' . $row['name_first'] . '&nbsp;' . $row['name_last'] . '</h4>
                    <h5 class="therapistedu">' . $row['license'] . '</h5>
                </div>
            </div>
        </a>
    </div>';
        }

        echo $output;
    } else {
        echo $output .= '<div class="col-md-4">
        <div class="card h-100 border-0">
            <div class="card-body">
                <h2>There is no result!</h2>
            </div>
        </div>
</div>';
    }
}


if (isset($_POST['login'])) { //if user login
    $servername = "localhost"; //localhost for local PC or use IP address
    $username = "root"; //database name
    $password = ""; //database password
    $database = "oncoun"; //database name

    // Create connection #scawx
    $conn = new mysqli($servername, $username, $password, $database);

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "select * from client where email='$email'"; //username and password same ？
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $passwordHash = $row['password'];
        }

        if (password_verify($password, $passwordHash)) {
            session_start();
            $_SESSION['client_id'] = $id;
            $_SESSION['client_name_first'] = $name_first;
            $_SESSION['client_name_last'] = $name_last;
            echo "success";
        } else {
            echo "wrong";
        }
    } else {
        echo "noFound";
    }
}
