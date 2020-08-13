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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/Admin.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>

<body>
	<section id="admin">
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
				<!-- <div class="card-header">
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
				</div> -->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-12 col-md-3">
										<a href="#" class="btn btn-danger btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-list-alt"></span><br />Appointment</a>
									</div>

									<div class="col-xs-12 col-md-3">
										<a href="#" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-signal"></span> <br />Reports</a>
									</div>


									<div class="col-xs-12 col-md-3">
										<a href="#" class="btn btn-primary btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-comment"></span> <br />Reviews</a>
									</div>

									<div class="col-xs-12 col-md-3">
										<a href="clientTable.php" class="btn btn-success btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-user"></span> <br />Client</a>
									</div>

									<div class="col-xs-12 col-md-3 my-5">
										<a href="therapistTable.php" class="btn btn-info btn-lg w-75 h-100" role="button">
											<span class="glyphicon glyphicon-user"></span> <br />Therapist</a>

									</div>

									<br>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	</div>
</body>


</html>
