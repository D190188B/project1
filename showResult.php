<?php
include("sessionTop.php");

if (isset($_SESSION['client_id'])) { //if already login
    $id = $_SESSION['client_id'];

    $sql = "select * from client where id ='$id'"; //id is database name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['client_id'] = $row['id'];
            $_SESSION['client_name_first'] = $row['name_first'];
            $_SESSION['client_name_last'] = $row['name_last'];
            $_SESSION['client_email'] = $row['email'];
            $_SESSION['client_birth'] = $row['birth'];
            $_SESSION['client_phone'] = $row['phone'];
            $_SESSION['client_address'] = $row['address'];
            $_SESSION['client_city'] = $row['city'];
            $_SESSION['client_state'] = $row['state'];
            $_SESSION['client_post_code'] = $row['post_code'];
            $_SESSION['client_profileImage'] = $row['profileImage'];
        }
    }
}

$email = $_SESSION['client_email'];

$query = "select * from user_choices where user_email='$email'";
$choices = $conn->query($query) or die($conn->error . __LINE__);

if ($choices->num_rows > 0) {
    while ($row = $choices->fetch_assoc()) {
        $_SESSION['generate_id'] = $row['selectID'];
        $choice1 = $row['choice_ID'];
        $_SESSION['user_email'] = $row['user_email'];
        switch ($choice1) {
            case 5:
            case 6:
            case 7:
                $_SESSION['choice_gender'] = $choice1;//get gender choice
                break;

            case 8:
            case 9:
            case 10:
                $_SESSION['choice_age'] = $choice1;//get age choice
                break;

            case 98:
            case 99:
            case 100:
                $_SESSION['choice_lan'] = $choice1;//get language choice
                break;
        }
    }
} else {
    $_SESSION['generate_id'] = '';
    $_SESSION['user_email'] = '';
}


if (isset($_POST['cancel'])) { //if user click cancel, clear all the data in database where the generate_id=this.generate_id
    $generate = $_SESSION['generate_id'];

    $sqli = "delete from user_choices where selectID='$generate'";
    $result1 = $conn->query($sqli) or die($conn->error . __LINE__);

    $_SESSION['rec_work_id'] = '';
    $_SESSION['work_id'] = '';

    echo '<script>window.location.assign("help.php");</script>';
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        body {
            background-color: rgba(210, 232, 243) !important;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<section id="showResult">

    <body>
        <h3>Answer the questions and get matched a suitable therapist!</h3>
        <hr id="ans">
        <div class="container">
            <div class="question-form">
                <h4 class="question-text"><strong>Recommendation</strong></h4>
                <hr>
                <div class="col-md-12">


                    <div class="row">
                        <?php include("ResultExtend.php") ?>

                        <div class="col-md-12">
                            <form action="showResult.php" method="POST" id="cancel">
                                <input type="submit" value="Cancel" name="cancel" id="cancel" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?')">
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </body>
</section>

</html>
