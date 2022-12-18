<?php
$title = "Users";
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/auth.php';
include_once __DIR__ . '/../includes/head.php';

session_start();
isLogged(true);
isTeacher();

if (!isset($_GET['id']))
	exit();
else
	$userId = $_GET['id'];

$grades = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM grades WHERE studentId={$userId}"));

if (!$grades) {
	header("location:" . BASE_PATH . "/app/index.php");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

	$eng = (int) trim($_POST['english']);
	$math = (int) trim($_POST['math']);
	$chem = (int) trim($_POST['chemistry']);
	$phy = (int) trim($_POST['physics']);
	$bio = (int) trim($_POST['bio']);
	mysqli_query($db, "UPDATE grades SET english='${eng}', math='${math}', chemistry='${chem}', physics='${phy}', bio='${bio}' WHERE studentId='${userId}'");
	header("Refresh: 0");
}
?>

<html lang="en" class="h-100">
<?php head($title); ?>

<body class="app">
	<div>
		<div class="row g-0">
			<div class="col">
				<?php include_once __DIR__ . '/components/sidebar/navbar.php'; ?>
			</div>
			<div class="col-10 container">
				<h1 class="display-6 mt-3">Update User Grades</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<?= $title ?>
						</li>
					</ol>
				</nav>
				<hr />
				<form method="POST">
					<div class="form-floating mb-3">
						<input type="number" class="form-control" value="<?= $grades['english'] ?>" name="english"
							min="0" max="100" step="1" required>
						<label for="floatingInputValue">English</label>
					</div>
					<div class="form-floating mb-3">
						<input type="number" class="form-control" value="<?= $grades['math'] ?>" name="math" min="0"
							max="100" step="1" required>
						<label for="floatingInputValue">Math</label>
					</div>
					<div class="form-floating mb-3">
						<input type="number" class="form-control" value="<?= $grades['chemistry'] ?>" name="chemistry"
							min="0" max="100" step="1" required>
						<label for="floatingInputValue">Chemistry</label>
					</div>
					<div class="form-floating mb-3">
						<input type="number" class="form-control" value="<?= $grades['physics'] ?>" name="physics"
							min="0" max="100" step="1" required>
						<label for="floatingInputValue">Physics</label>
					</div>
					<div class="form-floating mb-3">
						<input type="number" class="form-control" value="<?= $grades['bio'] ?>" name="bio" min="0"
							max="100" step="1" required>
						<label for="floatingInputValue">Bio</label>
					</div>
					<button class="w-100 btn btn-primary fw-semibold" type="submit" name="update">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>