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
