<?php
$servername = "localhost";//localhost for local PC or use IP address
$username = "root"; //database name
$password = "";//database password
$database = "oncoun";//database name

// Create connection #scawx
$conn = new mysqli($servername, $username, $password,$database);

// Check connection #scawx
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}

session_start();

if(isset($_POST['logout'])){

    session_destroy();
    header('location:Home.php');
  }
?>

<!doctype html>
<html lang="en">
<head>
    <title>Home</title>
</head>


<header>
<?php require_once ("header1.php"); ?>
</header>
  
<body>
<div class="content" >

  <form action="FAQ.php" method=POST>
    <input type="submit" value="log out" name="logout" style="margin-top:300px;margin-left:300px;">
    </form>
  
    
</div>

</body>




</html>

  