<?php
if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and age<=44 and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and age<=44 and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and age<=44 and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and age>=45 and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and age>=45 and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and age>=45 and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 98))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and English='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and age<=44 and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and age<=44 and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and age<=44 and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and age<=44 and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and age<=44 and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 8) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and age<=44 and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and age>=45 and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and age>=45 and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and age>=45 and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and age>=45 and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and age>=45 and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 9) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and age>=45 and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 5) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Male' and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 6) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and gender='Female' and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 99))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and Malay='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

        <?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
} else if ((($_SESSION['choice_gender']) == 7) && (($_SESSION['choice_age']) == 10) && (($_SESSION['choice_lan'] == 100))) {
    $sqli = "SELECT * FROM `therapist` LEFT JOIN `language` on therapist.therapist_id=language.thera_ID where statusID='2' and Mandarin='Yes'";
    $run = $conn->query($sqli) or die($conn->error . __LINE__);
    if ($run->num_rows > 0) { //over 1 database(record) so run
        while ($row = $run->fetch_assoc()) {
            $id = $row['therapist_id']; //[] inside is follow database 
            $name_first = $row['name_first'];
            $name_last = $row['name_last'];
            $ic = $row['ic'];
            $age = $row['age'];
            $address = $row['address'];
            $therapist_city = $row['therapist_city'];
            $therapist_postCode = $row['therapist_postCode'];
            $therapist_state = $row['therapist_state'];
            $license = $row['license'];
            $profile_image = $row['profile_image'];
            $gender = $row['gender'];
        ?>
            <div class="col-md-6">
                <img src="<?php echo $profile_image ?>" alt="image">

            </div>
            <div class="col-md-6">
                <p>
                    Name: <?php echo $name_first . "&nbsp;" . $name_last ?> <br>
                    Age: <?php echo $age ?> <br>
                    Gender: <?php echo $gender ?> <br>
                    License: <?php echo $license ?> <br>
                    Address: <?php echo $address . "&nbsp;" . $therapist_postCode . "&nbsp;" . $therapist_city . "&nbsp;" . $therapist_state ?><br>

                </p>
                <h2><?php echo $license ?></h2>
                <a href="Appointment.php?id=<?php echo $id ?>"><button type="submit" name="submit" id="submit" class="btn btn-outline-success">Make Appointment Now!</button></a>


            </div>
            <div class="col-md-12">
                <hr>
            </div>

<?php }
    } else {
        $generate = $_SESSION['generate_id'];

        $sql = "delete from select_question where generate_id='$generate'";
        $result = $conn->query($sql) or die($conn->error . __LINE__);


        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

        echo '<script>window.alert("No result,Please try again!");window.location.assign("help.php")</script>';
    }
}
?>