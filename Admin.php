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
    <title>Admin</title>
</head>


<header>
<?php require_once ("header2.php"); ?>
</header>
  
<body>
	<div class="container">

		<!-- page-header -->
		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="page-caption">
							<h1 class="page-title">Welcome Admin</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.page-header-->
		<div class="card text-center">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link active" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="therapist.php">Therapist</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="client.php">Client</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="appointment.php">Appointment</a>
					</li>
				</ul>
			</div>

			<br>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-12 col-md-3">
									<a href="#" class="btn btn-danger btn-lg" role="button">
										<span class="glyphicon glyphicon-list-alt"></span> <br />Appointment</a>
								</div>

								<div class="col-xs-12 col-md-3">
									<a href="#" class="btn btn-warning btn-lg" role="button">
										<span class="glyphicon glyphicon-bookmark"></span> <br />Bookmarks</a>
								</div>

								<div class="col-xs-12 col-md-3">
									<a href="#" class="btn btn-primary btn-lg" role="button">
										<span class="glyphicon glyphicon-signal"></span> <br />Reports</a>
								</div>


								<div class="col-xs-12 col-md-3">
									<a href="#" class="btn btn-primary btn-lg" role="button">
										<span class="glyphicon glyphicon-comment"></span> <br />Comments</a>
								</div>

							</div>
							<br>
							</br>
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<a href="#" class="btn btn-success btn-lg" role="button">
										<span class="glyphicon glyphicon-user"></span> <br />Client</a>
								</div>
								<div class="col-xs-12 col-md-6">
									<a href="#" class="btn btn-info btn-lg" role="button">
										<span class="glyphicon glyphicon-file"></span> <br />Therapist</a>
								</div>
							</div>
							<br>
						</div>

					</div>

				</div>
			</div>
		</div>




	</div>
	<footer>
  <?php require_once ("footer.php");?>

</footer>

</body>


</html>