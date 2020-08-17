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
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "select * from client where id ='$id'"; //id is database name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { //over 1 database(record) so run
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['birth'] = $row['birth'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['profileImage'] = $row['profileImage'];
        }
    }
}
//question number
$number = (int)1;
//get questions
$query = "select * from questions where question_number=$number";



//result
$result = $conn->query($query) or die($conn->error . __LINE__);
$questions = $result->fetch_assoc();
$total = $result->num_rows;

//get choices
$query = "select * from choices where question_number=$number";
$choices = $conn->query($query) or die($conn->error . __LINE__);


if (isset($_POST['submit'])) {

    $number = $_POST['number'];
    $choice = $_POST['choice'];
    $email = $_POST['email'];
    $generate = $_SESSION['generate_id'];
    $query2 = "insert into user_choices values('','$generate','$choice','$email')";
    $results = $conn->query($query2) or die($conn->error . __LINE__);

    $next = ++$number;

    //get question
    $query = "select * from questions where question_number=$next";
    $result = $conn->query($query) or die($conn->error . __LINE__);
    $questions = $result->fetch_assoc();
    $total = $next;

    if (($result == true) && ((int)$next >= 11) && ((int)$next <= 20)) {
        echo '<style type="text/css"> 
        p#over{
            display:block !important;            
        }</style>';
    }


    //get choices
    $query1 = "select * from choices where question_number=$next";
    $choices = $conn->query($query1) or die($conn->error . __LINE__);
}

if (isset($_POST['cancel'])) {

    $number = $_POST['number'];

    $generate = $_SESSION['generate_id'];

    $sql = "delete from select_question where generate_id='$generate'";
    $result = $conn->query($sql) or die($conn->error . __LINE__);

    if ($number >= 2) {
        $sqli = "delete from user_choices where selectID='$generate'";
        $result1 = $conn->query($sqli) or die($conn->error . __LINE__);
    }

    if ($result == true) {
        echo '<script>window.alert("Cancel Successful..!");window.location.assign("help.php");</script>';
    }
}

if (isset($_POST['finish'])) {
    echo '<script>window.location.assign("Appointment.php")</script>';
}

$Email = $_SESSION['email'];

$sql = "SELECT * FROM `select_question` WHERE user_email='$Email'";
$result1 = $conn->query($sql);
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $_SESSION['generate_id'] = $row['generate_id'];
        $_SESSION['user_email'] = $row['user_email'];
    }
} else {
    $_SESSION['generate_id'] = '';
    $_SESSION['user_email'] = '';
}
?>





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<!DOCTYPE html>
<html lang="en">
<section id="Question">

    <body>

        <h3>Answer the questions and get matched a suitable therapist!</h3>
        <hr id="ans">
        <p><?php echo $total ?>/26</p>
        <div class="container">
            <div class="question-form">
                <form action="question.php" method="post">
                    <p id="over">Over the past 2 weeks, how often have you bothered by any of the following problems: </p>
                    <h4 class="question-text"><strong><?php echo $questions['question_text'] ?></strong></h4>
                    <hr>
                    <ul class="choices">
                        <?php while ($row = $choices->fetch_assoc()) : ?>
                            <li><input type="radio" required name="choice" id="choice" value="<?php echo $row['choice_id'] ?>" checked><strong><span><?php echo $row['text'] ?></span></strong></li>
                        <?php endwhile; ?>
                    </ul>

                    <?php if ($number <= 25) {
                        echo "<input type=\"submit\" value=\"Next\" name=\"submit\" class=\"btn btn-outline-success\">";
                    } else {
                        echo "<input type=\"submit\" value=\"Finish\" name=\"finish\" class=\"btn btn-outline-success\">";
                    }
                    ?>
                    <input type="submit" value="Cancel" name="cancel" id="cancel" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?')">
                    <input type="hidden" name="number" value="<?php echo $number ?>">
                    <input name="big_id" type="hidden" value="<?php echo $_SESSION['generate_id'] ?>">
                    <input name="email" type="hidden" value="<?php echo $_SESSION['email'] ?>">
                </form>

            </div>
        </div>
    </body>
</section>

</html>