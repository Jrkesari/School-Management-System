<?php
$title = "Home";
require_once __DIR__.'/../includes/database.php';
require_once __DIR__.'/../includes/auth.php';
include_once __DIR__.'/../includes/head.php';

session_start();
isLogged(true);

$students_no = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT('id') FROM users WHERE user_type='0'"));
$teachers_no = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT('id') FROM users WHERE user_type='1'"));

?>

<html lang="en" class="h-100">
	<?php head($title); ?>
	<body class="app">
		<div>
			<div class="row g-0">
				<div class="col">
					<?php include_once __DIR__.'/components/sidebar/navbar.php'; ?>
				</div>
				<div class="col-10 container">
					<div class="alert alert-success mt-3">
						<h4 class="alert-heading">Welcome back, <?= $_SESSION['username'] ?>!</h4>
						<p class="mb-0">You are a <?= $_SESSION['type'] === "1" ? 'teacher' : 'student' ?>.</p>
					</div>
					<div class="row g-3">
						<div class="col">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Students:</h5>
									<h6 class="card-subtitle mb-2 text-muted"><?= $students_no["COUNT('id')"] ?></h6>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Teachers:</h5>
									<h6 class="card-subtitle mb-2 text-muted"><?= $teachers_no["COUNT('id')"] ?></h6>
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-body">
							"<span id="getQuote" class="fst-italic"></span>" &mdash; <span id="getAuthor" class="fw-bold"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/quotes.js"></script>
	</body>
</html>